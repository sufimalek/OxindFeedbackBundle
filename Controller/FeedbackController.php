<?php

namespace Oxind\FeedbackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * 
     * @param integer $feedbacktype_id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \InvalidArgumentException
     */
    public function listFeedbackAction($feedbacktype_id)
    {
        $feedbackTypeManager = $this->get('oxind_feedback.manager.feedbacktype');
        $feedbackType = $feedbackTypeManager->findFeedbackTypeById($feedbacktype_id);

        if ($feedbackType === null)
        {
            throw new \InvalidArgumentException('function : ' . __FUNCTION__ . '. line :' . __LINE__ . '. Invalid feedbacktype_id');
        }

        $feedbackManager = $this->get('oxind_feedback.manager.feedback');
        $feedbacks = $feedbackManager->findFeedbacksByFeedbackType($feedbackType);
         
        return $this->getFeedbackListResponce($feedbacks, $feedbacktype_id);
        
    }

    /**
     * @Route("/search", name="oxind_feedback_search")
     * @Method({"GET"})
     */
    public function getSearchAction(Request $request)
    {
        $queryData = $request->query->get('q');
        $feedbacktype_id = $request->query->get('feedbacktype_id');
        if ($queryData)
        {
            $feedbackManager = $this->get('oxind_feedback.manager.feedback');
            $feedbacks = $feedbackManager->findFeedbackByQuery($queryData);
            return $this->getFeedbackListResponce($feedbacks, $feedbacktype_id);
        } else
        {
            return $this->forward('OxindFeedbackBundle:Feedback:listFeedback', 
                    array('feedbacktype_id' => $feedbacktype_id));
        }
    }
    
    private function getFeedbackListResponce($feedbacks, $feedbacktype_id)
    {
        $voteManager = $this->get('oxind_feedback.manager.vote');
        $totalVote = $voteManager->getVoteTotalPoints();
        $userVotes = $voteManager->getVoteTotalPoints();
        return $this->render('OxindFeedbackBundle:Feedback:list.html.twig', array(
                    'feedbacks' => $feedbacks,
                    'total_vote' => $totalVote,
                    'feedbacktype_id' => $feedbacktype_id
        ));
    }

}
