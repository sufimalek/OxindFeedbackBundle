<?php

namespace Oxind\FeedbackBundle\Model\Manager;

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        $vote->setUser($user);
        $vote->setFeedback($feedback);
        $vote->setPoints($points);
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

    /**
     * Function to save Votes
     * @param \Oxind\FeedbackBundle\Model\VoteInterface $vote
     * @return type
     */
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
