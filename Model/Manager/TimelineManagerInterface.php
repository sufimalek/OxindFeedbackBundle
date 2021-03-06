<?php

namespace Oxind\FeedbackBundle\Model\Manager;

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Oxind\FeedbackBundle\Model\TimelineInterface;

/**
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
interface TimelineManagerInterface
{

    /**
     * Returns the class of the Timeline object.
     *
     * @return string
     */
    public function getClass();

    /**
     * 
     * @param string  $timeline
     * @return \Oxind\FeedbackBundle\Model\TimelineInterface $timeline
     */
    public function createTimeline(TimelineInterface $timeline);

    /**
     * Persists a timeline.
     *
     * @param  TimelineInterface $timeline
     * @return void
     */
    public function saveTimeline(TimelineInterface $timeline);

    /**
     * Finds a timeline by specified criteria.
     *
     * @param  array $criteria
     * @return TimelineInterface
     */
    public function findTimelineBy(array $criteria);

    /**
     * Finds a timeline by id.
     *
     * @param  $id
     * @return Feedbacknterface
     */
    public function findTimelineById($id);
}
