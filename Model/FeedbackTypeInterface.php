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
     * Add $status to the value of statuses array.
     *
     * @param string $status
     * @return FeedbackTypeInterface
     */
    public function addStatuses($status);

    /**
     * Get the value of statuses.
     *
     * @return array
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

    /**
     * Add $status to the value of statuses array.
     *
     * @param string $status
     * @return FeedbackTypeInterface
     */
    public function addDisplayableStatuses($status);

    /**
     * Get the value of displaybleStatuses.
     *
     * @return array
     */
    public function getDisplayableStatuses();

    /**
     * Get timeline_start_status
     * @return string
     */
    public function getTimelineStartStatus();

    /**
     * @param string $status when feedback seted to this status it will be added to timeline.
     * @return FeedbackTypeInterface
     */
    public function setTimelineEndStatus($status);

    /**
     * Get timeline_end_status
     * @return string
     */
    public function getTimelineEndStatus();

    /**
     * @param string $status when feedback seted to this status it will set end time in to timeline.
     * @return FeedbackTypeInterface
     */
    public function setTimelineStartStatus($status);

    /**
     * Get credit_vote_status
     * @return string
     */
    public function getCreditVoteStatus();

    /**
     * @param string $status when feedback seted to this status it will set end time in to timeline.
     * @return FeedbackTypeInterface
     */
    public function setCreditVoteStatus($status);
}
