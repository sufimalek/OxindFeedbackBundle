<?php

namespace Oxind\FeedbackBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

interface VoteInterface
{
    
    /**
     * Set the value of points.
     *
     * @param integer $points
     * @return VoteInterface
     */
    public function setPoints($points);

    /**
     * Get the value of points.
     *
     * @return integer
     */
    public function getPoints();

    /**
     * Set Feedback entity (many to one).
     *
     * @param FeedbackInterface $feedback
     * @return VoteInterface
     */
    public function setFeedback(FeedbackInterface $feedback );

    /**
     * Get Feedback entity (many to one).
     *
     * @return FeedbackInterface
     */
    public function getFeedback();

    /**
     * Set User entity (many to one).
     *
     * @param UserInterface $user
     * @return VoteInterface
     */
    public function setUser(UserInterface $user);

    /**
     * Get User entity (many to one).
     *
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUser();
    
}