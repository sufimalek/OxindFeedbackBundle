<?php

namespace Oxind\FeedbackBundle\Controller;

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

        $resultsPerPage = $this->container->getParameter('oxind_feedback.feedback_per_page');
        $pageNo = 0;

        $feedbackType = $feedbackTypeManager->findFeedbackTypeById($feedbacktype_id);

        if ($feedbackType === null)
        {
            throw new \InvalidArgumentException('function : ' . __FUNCTION__ . '. line :' . __LINE__ . '. Invalid feedbacktype_id');
        }

        $feedbackManager = $this->get('oxind_feedback.manager.feedback');
        $findFeedback = $feedbackManager->findFeedbacksForPage($feedbackType, $pageNo, $resultsPerPage);
        $totalFeedbacks = $findFeedback->count();
        $pageCount = ceil($totalFeedbacks / $resultsPerPage);

        return $this->getFeedbackListResponce($findFeedback, $feedbacktype_id, $pageCount);
    }

    /**
     * @Route("/search", name="oxind_feedback_search")
     * @Method({"GET|POST"})
     */
    public function getSearchAction(Request $request)
    {        
        $resultsPerPage = $this->container->getParameter('oxind_feedback.feedback_per_page');
        // Get pagenumber
        $asFormData = $request->get('feecback_filter');
        $snIdFeedbackType = $request->query->get('feedbacktype_id');
        $obFeedbackManager = $this->get('oxind_feedback.manager.feedback');
        if (!empty($asFormData))
        {
            $snIdFeedbackType = $asFormData['feedbacktype_id'];
            $ssStatus = $asFormData['statuses'];
            $ssSearch = $asFormData['search'];
            $ssPage = $asFormData['page'];
            $feedbacks = $obFeedbackManager->findFeedbackByQuery(
                    array('feedbacktype_id' => $snIdFeedbackType,
                'statuses' => $ssStatus,
                'title' => $ssSearch,
                    ), $ssPage, $resultsPerPage);

            $totalCount = $feedbacks->count();            
            $pageCount = ceil($totalCount / $resultsPerPage);
            return $this->getFeedbackListResponce($feedbacks, $snIdFeedbackType, $pageCount);
        } else
        {
            return $this->forward('OxindFeedbackBundle:Feedback:listFeedback', array('feedbacktype_id' => $snIdFeedbackType));
        }
    }

    /**
     * 
     * @param array $feedbacks
     * @param integer $feedbacktype_id
     * @param integer $pageCount
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function getFeedbackListResponce($feedbacks, $feedbacktype_id, $pageCount)
    {
        $voteManager = $this->get('oxind_feedback.manager.vote');
        $totalVote = $voteManager->getVoteTotalPoints();
        return $this->render('OxindFeedbackBundle:Feedback:list.html.twig', array(
                    'feedbacks' => $feedbacks,
                    'total_vote' => $totalVote,
                    'feedbacktype_id' => $feedbacktype_id,
                    'page_count' => $pageCount,
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
                {
                    $asFeedbackTypeStatus[strtolower($ssValue)] = ucfirst($ssValue);
                }
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

    /**
     * 
     * @param integer $message
     * @return type
     */
    protected function setFlashMessage($message)
    {
        return $this->get('session')
                        ->getFlashBag()
                        ->set('success', $this->get('translator')->trans($message, array(), 'feedback'));
    }

}
