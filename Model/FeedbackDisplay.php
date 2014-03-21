<?php

namespace Oxind\FeedbackBundle\Model;

class FeedbackDisplay implements FeedbackDisplayInterface
{
    /**
     *
     * @var \DateTime
     */
    protected $start_date;
    
    /**
     *
     * @var \DateTime
     */
    protected $end_date;

    /**
     *
     * @var Feedback 
     */
    protected $feedback;

    /**
     *
     * @var TimelineInterface 
     */
    protected $timeline;

    /**
     * Set the value of start_date.
     *
     * @param  \DateTime $start_date
     * @return FeedbackDisplay
     */
    public function setStartDate(\DateTime $start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    /**
     * Get the value of start_date.
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set the value of end_date.
     *
     * @param  \DateTime $end_date
     * @return FeedbackDisplay
     */
    public function setEndDate(\DateTime $end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * Get the value of end_date.
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set Feedback entity (many to one).
     *
     * @param FeedbackInterface $feedback
     * @return FeedbackDisplay
     */
    public function setFeedback(FeedbackInterface $feedback)
    {
        $this->feedback = $feedback;

        return $this;
    }

    /**
     * Get Feedback entity (many to one).
     *
     * @return Feedback
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * Set Timeline entity (many to one).
     *
     * @param TimelineInterface $timeline
     * @return FeedbackDisplay
     */
    public function setTimeline(TimelineInterface $timeline)
    {
        $this->timeline = $timeline;

        return $this;
    }

    /**
     * Get Timeline entity (many to one).
     *
     * @return TimelineInterface
     */
    public function getTimeline()
    {
        return $this->timeline;
    }
}