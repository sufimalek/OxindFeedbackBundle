<?php

namespace Oxind\FeedbackBundle\Model;

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
     * @var array
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
     * @var array
     */
    protected $displayable_statuses;

    /**
     *
     * @var string 
     */
    protected $timeline_start_status;

    /**
     *
     * @var string 
     */
    protected $timeline_end_status;

    /**
     *
     * @var string 
     */
    protected $credit_vote_status;

    /**
     *
     * @var \Doctrine\Common\Collections\Collection 
     */
    protected $feedbacks;

    public function __construct()
    {
        $this->feedbacks = new ArrayCollection();
        $this->statuses = array();
        $this->displayable_statuses = array();
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
    public function addStatuses($status)
    {
        $this->statuses[] = $status;

        return $this;
    }

    /**
     * Get the value of statuses.
     *
     * @return array
     */
    public function getStatuses()
    {
        return $this->statuses;
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

    /**
     * Add $status to the value of statuses array.
     *
     * @param string $status
     * @return FeedbackTypeInterface
     */
    public function addDisplayableStatuses($status)
    {
        $this->displayable_statuses[] = $status;

        return $this;
    }

    /**
     * Get the value of displaybleStatuses.
     *
     * @return array
     */
    public function getDisplayableStatuses()
    {
        return $this->displayable_statuses;
    }

    public function setTimelineStartStatus($status)
    {
        $this->timeline_start_status = $status;
        return $this;
    }

    /**
     * Get timeline_start_status
     * @return string
     */
    public function getTimelineStartStatus()
    {
        return $this->timeline_start_status;
    }

    /**
     * @param string $status when feedback seted to this status it will be added to timeline.
     * @return FeedbackTypeInterface
     */
    public function setTimelineEndStatus($status)
    {
        $this->timeline_end_status = $status;
        return $this;
    }

    /**
     * Get timeline_end_status
     * @return string
     */
    public function getTimelineEndStatus()
    {
        return $this->timeline_end_status;
    }

    public function getCreditVoteStatus()
    {
        return $this->credit_vote_status;
    }

    public function setCreditVoteStatus($status)
    {
        $this->credit_vote_status = $status;
        return $this;
    }

}
