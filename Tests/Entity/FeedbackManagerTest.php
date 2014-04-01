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
 * Description of FeedbackManagerTest
 *
 * @author Hardik Patel <hpatel@oxind.com>
 */
class FeedbackManagerTest extends OxindWebTestCase
{

    /**
     * 
     * @var \Oxind\FeedbackBundle\Entity\FeedbackManager 
     */
    private $obFeedbackManager;

    /**
     *
     * @var \Oxind\FeedbackBundle\Model\Feedback
     */
    private $obFeedback;

    /**
     *
     * @var \Oxind\FeedbackBundle\Model\FeedbackType
     */
    protected $obFeedbackType;

    /**
     *
     * @var \Oxind\FeedbackBundle\Model\VoteInterface 
     */
    private $asVotes;

    /**
     * Function to setUp required configurations
     */
    public function setUp()
    {
        parent::setUp();
        $this->obFeedbackManager = $this->getManager('oxind_feedback.manager.feedback.default');


        $this->obFeedbackType = $this->getFeedbackType();
        $this->obFeedback = $this->setFeedbackValues();
    }

    /**
     * Function to test findFeedbackBy method
     */
    public function testFindFeedbackBy()
    {
        $asFeedback = $this->obFeedbackManager->findFeedbackBy(array('id' => 1));
        $this->assertTrue(count($asFeedback) > 0);
    }

    /**
     * Function to test findFeedbacksBy method
     */
    public function testFindFeedbacksBy()
    {
        $asFeedback = $this->obFeedbackManager->findFeedbacksBy(array('id' => 1));
        $this->assertTrue(count($asFeedback) > 0);
    }

    /**
     * Function to test findFeedbacksByStatus method
     */
    public function testFindFeedbacksByStatus()
    {
        $asFeedback = $this->obFeedbackManager->findFeedbacksByStatus('Open');
        $this->assertTrue(count($asFeedback) > 0);
    }

    /**
     * Function to test findFeedbackById method
     */
    public function testFindFeedbacksById()
    {
        $asFeedback = $this->obFeedbackManager->findFeedbackById(1);
        $this->assertTrue(count($asFeedback) > 0);
    }

    /**
     * Function to test getClass Method
     */
    public function testGetClass()
    {
        $ssClass = $this->obFeedbackManager->getClass();
        $this->assertEquals('Oxind\DashboardBundle\Entity\Feedback', $ssClass);
    }

    /**
     * Function to test findAll method
     */
    public function testFindAll()
    {
        $asFeedback = $this->obFeedbackManager->findAll();
        $this->assertTrue(count($asFeedback) > 0);
    }

    /**
     * Function to test saveFeedback method
     */
    public function testSaveFeedback()
    {
        $obFeedback = $this->obFeedbackManager->saveFeedback($this->obFeedback);
        var_dump($obFeedback);
    }

    /**
     * Function to set feedbackType Values
     * @return \Oxind\FeedbackBundle\Entity\Feedback
     */
    protected function setFeedbackValues()
    {

        $this->obUser = $this->getUserData(array('id' => 2));
        $date = new \DateTime();
        $this->obFeedback = new \Oxind\DashboardBundle\Entity\Feedback();
        $this->obFeedback->setUser($this->obUser);

        $this->obFeedback->setTitle('FeedbackTest');
        $this->obFeedback->setContent('Feedback test , Feedback test ');
        $this->obFeedback->setStatus('Open');
        $this->obFeedback->setFeedbackType($this->obFeedbackType);
        $this->obFeedback->setCreatedAt($date);
        $this->obFeedback->setUpdatedAt($date);
        return $this->obFeedback;
    }

    /**
     * Function to get FeedbackType
     * @return type
     */
    protected function getFeedbackType()
    {
        $obFeedbackType = $this->getManager('oxind_feedback.manager.feedbacktype.default');
        return $obFeedbackType->findFeedbackTypeById('1');
    }

}
