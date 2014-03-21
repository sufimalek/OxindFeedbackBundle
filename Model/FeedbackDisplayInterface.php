<?php

namespace Oxind\FeedbackBundle\Model;

interface FeedbackDisplayInterface
{
    /**
     * Set the value of start_date.
     *
     * @param  \DateTime $start_date
     * @return FeedbackDisplayInterface
     */
    public function setStartDate(\DateTime $start_date);

    /**
     * Get the value of start_date.
     *
     * @return \DateTime
     */
    public function getStartDate();

    /**
     * Set the value of end_date.
     *
     * @param  \DateTime $end_date
     * @return FeedbackDisplayInterface
     */
    public function setEndDate(\DateTime $end_date);

    /**
     * Get the value of end_date.
     *
     * @return 
     */
    public function getEndDate();

    /**
     * Set Feedback entity (many to one).
     *
     * @param FeedbackInterface $feedback
     * @return FeedbackDisplayInterface
     */
    public function setFeedback(FeedbackInterface $feedback);

    /**
     * Get Feedback entity (many to one).
     *
     * @return FeedbackInterface
     */
    public function getFeedback();

    /**
     * Set Timeline entity (many to one).
     *
     * @param TimelineInterface $timeline
     * @return 
     */
    public function setTimeline(TimelineInterface $timeline );

    /**
     * Get Timeline entity (many to one).
     *
     * @return TimelineInterface
     */
    public function getTimeline();
    
}