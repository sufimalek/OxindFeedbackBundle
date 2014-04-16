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

class FeedbackDisplay implements FeedbackDisplayInterface
{

    /**
     *
     * @var integer 
     */
    protected $id;

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
     * Set the value of id.
     *
     * @param integer $id
     * @return FeedbackDisplayInterface
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