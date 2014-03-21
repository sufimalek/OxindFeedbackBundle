<?php

namespace Oxind\FeedbackBundle\Model;

interface FeedbackTypeInterface 
{
    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return FeedbackTypeInterface
     */
    public function setId($id);

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId();

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return FeedbackTypeInterface
     */
    public function setName($name);

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set the value of statuses.
     *
     * @param string $statuses
     * @return FeedbackTypeInterface
     */
    public function setStatuses($statuses);

    /**
     * Get the value of statuses.
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getStatuses();

    /**
     * Set the value of votable.
     *
     * @param boolean $votable
     * @return FeedbackTypeInterface
     */
    public function setVotable($votable);

    /**
     * Get the value of votable.
     *
     * @return boolean
     */
    public function getVotable();

    /**
     * Set the value of vote_min_point.
     *
     * @param integer $vote_min_point
     * @return FeedbackTypeInterface
     */
    public function setVoteMinPoint($vote_min_point);

    /**
     * Get the value of vote_min_point.
     *
     * @return integer
     */
    public function getVoteMinPoint();

    /**
     * Set the value of vote_max_point.
     *
     * @param integer $vote_max_point
     * @return FeedbackTypeInterface
     */
    public function setVoteMaxPoint($vote_max_point);

    /**
     * Get the value of vote_max_point.
     *
     * @return integer
     */
    public function getVoteMaxPoint();

    /**
     * Add Feedback entity to collection (one to many).
     *
     * @param FeedbackInterface $feedback
     * @return FeedbackTypeInterface
     */
    public function addFeedback(FeedbackInterface $feedback);

    /**
     * Get Feedback entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeedbacks();

}