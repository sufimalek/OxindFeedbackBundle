<?php

namespace Oxind\FeedbackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Oxind\FeedbackBundle\Form\Type\FeedbackFilter;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of FeedbackController
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 * @Route("/feedback")
 */
class FeedbackController extends Controller
{

    const SESSION_FEEDBACKTYPE = 'oxind_feedback.feedbactype';

    /**
     * @Route("/create/{feedbacktype_id}", name="oxind_feedback_create")
     * @Method({"GET"})
     */
    public function getFeedbackFormAction($feedbacktype_id)
    {
        $form = $this->get('oxind_feedback.form_factory.feedback')->createForm();

        $form->add('feedback_id', 'hidden', array(
            'mapped' => false,
            'attr' => array('value' => $feedbacktype_id),
        ));

        return $this->render('OxindFeedbackBundle:Feedback:create.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/create", name="oxind_feedback_create")
     * @Method({"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function createFeedbackAction(Request $request)
    {
        $feedbackTypeManager = $this->get('oxind_feedback.manager.feedbacktype');
        $feedbackManager = $this->get('oxind_feedback.manager.feedback');

        $form = $this->get('oxind_feedback.form_factory.feedback')->createForm();

        $feedback = $request->request->get('oxind_feedback_feedback');
        $feedbacktype_id = $feedback['feedback_id'];
        $feedbackType = $feedbackTypeManager->findFeedbackTypeBy(array('id' => $feedbacktype_id));

        $form->handleRequest($request);
        $formData = $form->getData();
        
        $feedback = $feedbackManager->createFeedback(
                $formData->getTitle(), $formData->getContent(), $feedbackType, $this->getUser()
        );
        $feedbackManager->saveFeedback($feedback);
        
        $this->setFlashMessage('flash_message.feedback_created');
        
        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/feedback_list", name="oxind_feedback_list")
     * @Method({"GET|POST"})
     * @param integer $feedbacktype_id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \InvalidArgumentException
     */
    public function listFeedbackAction($feedbacktype_id)
    {
        $feedbackTypeManager = $this->get('oxind_feedback.manager.feedbacktype');

        $feedbackType = $feedbackTypeManager->findFeedbackTypeById($feedbacktype_id);

        $obFormFilter = $this->createForm(new FeedbackFilter($feedbackType), null, array(
            'action' => $this->generateUrl('oxind_feedback_search')));

        if ($feedbackType === null)
        {
            throw new \InvalidArgumentException('function : ' . __FUNCTION__ . '. line :' . __LINE__ . '. Invalid feedbacktype_id');
        }

        $feedbackManager = $this->get('oxind_feedback.manager.feedback');
        $feedbacks = $feedbackManager->findFeedbacksByFeedbackType($feedbackType);

        return $this->getFeedbackListResponce($feedbacks, $feedbacktype_id, $obFormFilter->createView());
    }

    /**
     * @Route("/search", name="oxind_feedback_search")
     * @Method({"GET|POST"})
     */
    public function getSearchAction(Request $request)
    {
        $ssSearchCriteria = $request->query->get('q');
        $asFormData = $request->get('feecback_filter');
        $snIdFeedbackType = $request->query->get('feedbacktype_id');
        $obFeedbackManager = $this->get('oxind_feedback.manager.feedback');
        if (!empty($asFormData))
        {
            $snIdFeedbackType = $asFormData['feedbacktype_id'];
            $ssStatus = $asFormData['statuses'];
            $feedbacks = $obFeedbackManager->findFeedbackByQuery(array('feedbacktype_id' => $snIdFeedbackType, 'statuses' => $ssStatus));
            return $this->getFeedbackListResponce($feedbacks, $snIdFeedbackType);
        } else if ($ssSearchCriteria)
        {
            
            $feedbacks = $obFeedbackManager->findFeedbackByQuery(array('title' => $ssSearchCriteria));
            return $this->getFeedbackListResponce($feedbacks, $snIdFeedbackType);
        } else
        {
            return $this->forward('OxindFeedbackBundle:Feedback:listFeedback', array('feedbacktype_id' => $snIdFeedbackType));
        }
    }

    /**
     * funtion to render list template
     * @param type $feedbacks
     * @param type $feedbacktype_id
     * @return type
     */
    private function getFeedbackListResponce($feedbacks, $feedbacktype_id)
    {
        $voteManager = $this->get('oxind_feedback.manager.vote');
        $totalVote = $voteManager->getVoteTotalPoints();
        return $this->render('OxindFeedbackBundle:Feedback:list.html.twig', array(
                    'feedbacks' => $feedbacks,
                    'total_vote' => $totalVote,
                    'feedbacktype_id' => $feedbacktype_id
        ));
    }

    /**
     * @Route("/statuslist", name="oxind_feedback_status_list")
     * @Method({"POST"})     
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function getStatusListAction(Request $request)
    {
        $snFeedbackTypeId = $request->get('id');
        $getFeedbackTypeStatuses = $this->getFeedbackTypeStatuses($snFeedbackTypeId);
        return new JsonResponse($getFeedbackTypeStatuses);
    }

    /**
     * Function to get array option for feedbacktype statuses
     * @return array
     */
    protected function getFeedbackTypeStatuses($snId)
    {
        $obFeedbackTypeManager = $this->get('oxind_feedback.manager.feedbacktype');
        $asFeedbackTypeStatus = array();

        if ($snId != '')
        {
            $obFeedbackType = $obFeedbackTypeManager->findFeedbackTypeById($snId);
            if ($obFeedbackType != null && !empty($obFeedbackType))
            {
                foreach ($obFeedbackType->getDisplayableStatuses() as $ssValue)
                    $asFeedbackTypeStatus[strtolower($ssValue)] = ucfirst($ssValue);
            }
        }

        return $asFeedbackTypeStatus;
    }

    /**
     * Action to render filters form
     * @param integer $feedbacktype_id
     * @return type
     */
    public function feedbackfilterAction($feedbacktype_id)
    {
        $feedbackTypeManager = $this->get('oxind_feedback.manager.feedbacktype');

        $feedbackType = $feedbackTypeManager->findFeedbackTypeById($feedbacktype_id);

        $obFormFilter = $this->createForm(new FeedbackFilter($feedbackType), null, array(
            'action' => $this->generateUrl('oxind_feedback_search')));

        return $this->render('OxindFeedbackBundle:Feedback:feedback_filters.html.twig', array(
                    'form' => $obFormFilter->createView(),
        ));
    }

    public function setFlashMessage($message)
    {
        return $this->get('session')
                ->getFlashBag()
                ->set('success', $this->get('translator')->trans($message, array(), 'feedback'));
    }
    
}
