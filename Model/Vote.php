<?php

namespace Oxind\FeedbackBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

abstract class Vote implements VoteInterface
{

    /**
     *
     * @var type 
     */
    protected $points;

    /**
     *
     * @var Feedback
     */
    protected $feedback;

    /**
     *
     * @var UserInterface 
     */
    protected $user;

    /**
     * 
     * @param integer $points
     * @return \Oxind\FeedbackBundle\Model\Vote
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * 
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\Feedback $feedback
     * @return \Oxind\FeedbackBundle\Model\Vote
     */
    public function setFeedback(FeedbackInterface $feedback)
    {
        $this->feedback = $feedback;

        return $this;
    }

    public function getFeedback()
    {
        return $this->feedback;
    }
    
    /**
     * 
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     * @return \Oxind\FeedbackBundle\Model\Vote
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * 
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

}