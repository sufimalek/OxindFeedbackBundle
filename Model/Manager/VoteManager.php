<?php

namespace Oxind\FeedbackBundle\Model\Manager;

use Oxind\FeedbackBundle\Model\FeedbackInterface;
use Oxind\FeedbackBundle\Model\VoteInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of VoteManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
abstract class VoteManager implements VoteManagerInterface
{
    public function createVote(UserInterface $user, FeedbackInterface $feedback, $points)
    {
        $class = $this->getClass();
        $vote = new $class();
        $vote->setFeedbackId($feedback);
        return $vote;
    }

    /**
     * 
     * @param integer $id
     * @return object
     */
    public function findVoteById($id)
    {
        return $this->findVoteBy(array('id' => $id));
    }

    public function saveVote(VoteInterface $vote)
    {
        return $this->doSaveVote($vote);
    }

    /**
     * Performs the persistence of a vote.
     *
     * @abstract
     * @param VoteInterface $vote
     */
    abstract protected function doSaveVote(VoteInterface $vote);
}
