<?php

namespace Oxind\FeedbackBundle\Tests\Entity;

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Oxind\FeedbackBundle\Tests\WebTestCase\OxindWebTestCase;

/**
 * Description of TimelineManagerTest
 *
 * @author Hardik Patel <hpatel@oxind.com>
 */
class TimelineManagerTest extends OxindWebTestCase
{

    /**
     *
     * @var \Oxind\FeedbackBundle\Entity\TimelineManager 
     */
    protected $obTimelineManager;

    /**
     *
     * @var \Oxind\FeedbackBundle\Model\Timeline 
     */
    protected $obTimeline;

    /**
     * Function to setUp required configurations
     */
    public function setUp()
    {
        parent::setUp();
        $this->obTimelineManager = $this->getManager('oxind_feedback.manager.timeline.default');
        $this->obTimeline = $this->setTimlineValues();
    }

    /**
     * Function to test findTimelineBy method
     */
    public function testfindTimelineBy()
    {
        $obTimelines = $this->obTimelineManager->findTimelineBy(array('title' => 'Timeline 1'));
        $this->assertTrue(count($obTimelines) > 0);
        $this->assertTrue(is_object($obTimelines));
    }

    /**
     * Function to test findTimelineById method
     */
    public function testfindTimelineById()
    {
        $obTimelines = $this->obTimelineManager->findTimelineById(1);
        $this->assertTrue(count($obTimelines) > 0);
        $this->assertTrue(is_object($obTimelines));
    }

    /**
     * Function to test getClass method
     */
    public function testgetClass()
    {
        $ssClass = $this->obTimelineManager->getClass();
        $this->assertTrue(count($ssClass) > 0);
        $this->assertTrue(is_string($ssClass));
    }

    public function testSaveTimeline()
    {
        $obTimline = $this->obTimelineManager->saveTimeline(\Oxind\FeedbackBundle\Model\TimelineInterface::$this->obTimeline);        
    }

    /**
     * Function to set timeline Values
     * @return \Oxind\FeedbackBundle\Entity\Timeline
     */
    protected function setTimlineValues()
    {
        $this->obTimeline = new \Oxind\DashboardBundle\Entity\Timeline();

        $this->obTimeline->setTitle('Test Timeline');
        $this->obTimeline->setDescription('Test Timeline Desc');

        return $this->obTimeline;
    }

}
