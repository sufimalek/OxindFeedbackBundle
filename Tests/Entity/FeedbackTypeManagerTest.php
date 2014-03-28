<?php

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oxind\FeedbackBundle\Tests\Entity;

use Oxind\FeedbackBundle\Tests\WebTestCase\OxindWebTestCase;

/**
 * Description of FeedbackTypeManagerTest
 *
 * @author Hardik Patel <hpatel@oxind.com>
 */
class FeedbackTypeManagerTest extends OxindWebTestCase
{

    /**
     *
     * @var \Oxind\FeedbackBundle\Entity\FeedbackTypeManager 
     */
    private $obFeedbackTypeManager;

    /**
     *
     * @var \Oxind\FeedbackBundle\Model\FeedbackType
     */
    private $obFeedbackType;

    public function setUp()
    {
        parent::setUp();
        $this->obFeedbackTypeManager = $this->getManager('oxind_feedback.manager.feedbacktype.default');
        $this->obFeedbackType = $this->setFeedbackTypeValues();
    }

    /**
     * Function to test findFeedbackTypeBy method
     */
    public function testFindFeedbackTypeBy()
    {
        $asFeedbackType = $this->obFeedbackTypeManager->findFeedbackTypeBy(array('id' => 1));
        $this->assertTrue(count($asFeedbackType) > 0);
    }

    /**
     * Function to test getClass Method
     */
    public function testGetClass()
    {
        $ssClass = $this->obFeedbackTypeManager->getClass();
        $this->assertEquals('Oxind\DashboardBundle\Entity\FeedbackType', $ssClass);
    }

    /**
     * Function to test findFeedbackTypeById method
     */
    public function testFindFeedbacksById()
    {
        $asFeedbackType = $this->obFeedbackTypeManager->findFeedbackTypeById(1);
        $this->assertTrue(count($asFeedbackType) > 0);
    }

    /**
     * Function to test createFeedbackType method
     */
    public function testCreateFeedbackType()
    {

        $obFeedbackType = $this->obFeedbackTypeManager->createFeedbackType($this->obFeedbackType, 1, 2);
        $this->assertTrue(count($obFeedbackType) > 0);
        $this->assertTrue(is_object($obFeedbackType));
    }
    
    
    /**
     * Function to test saveFeedbackType method
     */
    public function testSaveFeedbackType()
    {
        $obFeedbackType = $this->obFeedbackTypeManager->saveFeedbackType($this->obFeedbackType);
        var_dump($obFeedbackType);
    }

    /**
     * Function to set feedbackType Values
     * @return \Oxind\FeedbackBundle\Entity\FeedbackType
     */
    protected function setFeedbackTypeValues()
    {
        $this->obFeedbackType = new \Oxind\DashboardBundle\Entity\FeedbackType();
        $this->obFeedbackType->setName('FeedbackTest1');
        $this->obFeedbackType->setStatuses(array('Open', 'Accepted', 'Rejected', 'Completed'));
        $this->obFeedbackType->setVotable(1);
        $this->obFeedbackType->setVoteMinPoint(1);
        $this->obFeedbackType->setVoteMaxPoint(5);

        return $this->obFeedbackType;
    }

}