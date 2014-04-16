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
 * Description of TimelineManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
abstract class TimelineManager implements TimelineManagerInterface
{

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\TimelineInterface $timeline
     * @return \Oxind\FeedbackBundle\Model\TimelineInterface
     */
    public function createTimeline(TimelineInterface $timeline)
    {
        $objTimeline = new TimelineInterface();
        $objTimeline->setTitle($objTimeline);

        return $objTimeline;
    }

    /**
     * 
     * @param integer $id
     * @return object
     */
    public function findTimelineById($id)
    {
        return $this->findTimelineBy(array('id' => $id));
    }

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\TimelineInterface $timeline
     * @throws \InvalidArgumentException
     */
    public function saveTimeline(TimelineInterface $timeline)
    {
        if (null === $timeline->getTitle())
        {
            throw new \InvalidArgumentException('Feedback not Setted');
        }

        $this->doSaveTimeline($timeline);
    }

    /**
     * Performs the persistence of a timeline.
     *
     * @abstract
     * @param TimelineInterface $timeline
     */
    abstract protected function doSaveTimeline(TimelineInterface $timeline);
}
