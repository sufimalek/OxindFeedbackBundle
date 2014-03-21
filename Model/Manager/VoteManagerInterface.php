<?php

namespace Oxind\FeedbackBundle\Model\Manager;

use Oxind\FeedbackBundle\Model\FeedbackInterface;
use Oxind\FeedbackBundle\Model\VoteInterface;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */

interface VoteManagerInterface
{
    /**
     * Returns the class of the Vote object.
     *
     * @return string
     */
    public function getClass();

    /**
     * 
     * @param string  $vote
     * @return \Oxind\FeedbackBundle\Model\VoteInterface $vote
     * @return \Symfony\Component\Security\Core\User\UserInterface $user
     */
    public function createVote(VoteInterface $vote, UserInterface $user, FeedbackInterface $feedback);

    /**
     * Persists a vote.
     *
     * @param  VoteInterface $vote
     * @return void
     */
    public function saveVote(VoteInterface $vote);

    /**
     * Finds a vote by specified criteria.
     *
     * @param  array $criteria
     * @return VoteInterface
     */
    public function findVoteBy(array $criteria);

    /**
     * Finds a vote by id.
     *
     * @param  $id
     * @return Feedbacknterface
     */
    public function findVoteById($id);

    /**
     * Finds a vote by id.
     *
     * @param  $id
     * @return Feedbacknterface
     */
    public function findVotesByfindFeedback(FeedbackInterface $feedback);
}
