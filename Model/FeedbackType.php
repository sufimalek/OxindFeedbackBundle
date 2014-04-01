<?php

namespace Oxind\FeedbackBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

class FeedbackType implements FeedbackTypeInterface
{

    /**
     *
     * @var integer 
     */
    protected $id;

    /**
     *
     * @var string 
     */
    protected $name;

    /**
     *
     * @var string 
     */
    protected $statuses;

    /**
     *
     * @var integer 
     */
    protected $votable;

    /**
     *
     * @var integer 
     */
    protected $vote_min_point;

    /**
     *
     * @var integer 
     */
    protected $vote_max_point;

    /**
     *
     * @var \Doctrine\Common\Collections\Collection 
     */
    protected $feedbacks;

    public function __construct()
    {
        $this->feedbacks = new ArrayCollection();
        $this->statuses = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return FeedbackType
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return  FeedbackType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of statuses.
     *
     * @param string $statuses
     * @return  FeedbackType
     */
    public function setStatuses($statuses)
    {
        $this->statuses = implode(',', $statuses);

        return $this;
    }

    /**
     * Get the value of statuses.
     *
     * @return string
     */
    public function getStatuses()
    {
        $asStatus = explode(',', $this->statuses);
        return $asStatus;
    }

    /**
     * Set the value of votable.
     *
     * @param boolean $votable
     * @return  FeedbackType
     */
    public function setVotable($votable)
    {
        $this->votable = $votable;

        return $this;
    }

    /**
     * Get the value of votable.
     *
     * @return boolean
     */
    public function getVotable()
    {
        return $this->votable;
    }

    /**
     * Set the value of vote_min_point.
     *
     * @param integer $vote_min_point
     * @return  FeedbackType
     */
    public function setVoteMinPoint($vote_min_point)
    {
        $this->vote_min_point = $vote_min_point;

        return $this;
    }

    /**
     * Get the value of vote_min_point.
     *
     * @return integer
     */
    public function getVoteMinPoint()
    {
        return $this->vote_min_point;
    }

    /**
     * Set the value of vote_max_point.
     *
     * @param integer $vote_max_point
     * @return  FeedbackType
     */
    public function setVoteMaxPoint($vote_max_point)
    {
        $this->vote_max_point = $vote_max_point;

        return $this;
    }

    /**
     * Get the value of vote_max_point.
     *
     * @return integer
     */
    public function getVoteMaxPoint()
    {
        return $this->vote_max_point;
    }

    /**
     * Add Feedback entity to collection (one to many).
     *
     * @param  Feedback $feedback
     * @return  FeedbackInterface
     */
    public function addFeedback(FeedbackInterface $feedback)
    {
        $this->feedbacks[] = $feedback;

        return $this;
    }

    /**
     * Get Feedback entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeedbacks()
    {
        return $this->feedbacks;
    }

}