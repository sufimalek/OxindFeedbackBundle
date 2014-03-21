<?php

namespace Oxind\FeedbackBundle\Model\Manager;

use Oxind\FeedbackBundle\Model\FeedbackInterface;
use Oxind\FeedbackBundle\Model\TimelineInterface;
use Oxind\FeedbackBundle\Model\FeedbackDisplayInterface;

/**
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */

interface FeedbackDisplayManagerInterface
{
    /**
     * Returns the class of the FeedbackDisplay object.
     *
     * @return string
     */
    public function getClass();

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\FeedbackInterface  $feedback
     * @param \Oxind\FeedbackBundle\Model\TimelineInterface  $timeline
     * @param \DateTime  $startDate
     * @param \DateTime  $endtDate
     * @return \Oxind\FeedbackBundle\Model\FeedbackDisplayInterface $feedbackType
     */
    public function createFeedbackDisplay(FeedbackInterface $feedback, TimelineInterface $timeline, $startDate, $endtDate);

    /**
     * Persists a feedbackType.
     *
     * @param  FeedbackDisplayInterface $feedbackDisplay
     * @return void
     */
    public function saveFeedbackDisplay(FeedbackDisplayInterface $feedbackDisplay);

    /**
     * Finds a feedbackDisplay by Timeline.
     *
     * @param  array $criteria
     * @return FeedbackDisplayInterface
     */
    public function findFeedbackDisplayByTimeline(TimelineInterface $timeline, FeedbackDisplayInterface $feedbackDisplay);
    
    /**
     * Finds a feedbackDisplay by specified criteria.
     *
     * @param  array $criteria
     * @return FeedbackDisplayInterface
     */
    public function findFeedbackDisplayBy(array $criteria);

    /**
     * Finds a feedbackType by id.
     *
     * @param  $id
     * @return Feedbacknterface
     */
    public function findFeedbackDisplayById($id);
}
