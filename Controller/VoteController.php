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

/**
 * Description of voteController
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 * @Route("/vote")
 */
class VoteController extends Controller
{

    /**
     * @Route("/create", name="oxind_feedback_vote_create")
     * @Method({"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function setVoteAction(Request $request)
    {
        $user = $this->getUser();
        $userPoints = $user->getPoints();
        $feedabck_id = $request->request->get('feedback_id');
        $points = $request->request->get('points');

        $voteManager = $this->get('oxind_feedback.manager.vote');
        $alreadyVoted = $voteManager->findVoteByUserAndFeedback($user->getId(), $feedabck_id);
        $countAlreadyVoted = count($alreadyVoted);



        if ($userPoints !== null && ($userPoints >= $points) && $countAlreadyVoted == 0)
        {
            $feedbackManager = $this->get('oxind_feedback.manager.feedback');
            $feedback = $feedbackManager->findFeedbackById($feedabck_id);
            $remainingPoints = $userPoints - $points;
            $user->setPoints($remainingPoints);
            $vote = $voteManager->createVote($user, $feedback, $points);
            $voteManager->saveVote($vote);

            $this->setFlashMessage('flash_message.vote_sent');
        } else
        {
            $this->setFlashMessage('flash_message.vote_sent');
        }

        return $this->redirect($request->headers->get('referer'));
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
