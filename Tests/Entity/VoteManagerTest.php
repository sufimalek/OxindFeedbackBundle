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
 * Description of VoteManagerTest
 *
 * @author Hardik Patel <hpatel@oxind.com>
 */
class VoteManagerTest extends OxindWebTestCase
{

    /**
     *
     * @var \Oxind\FeedbackBundle\Entity\VoteManager 
     */
    protected $obVoteManager;

    /**
     *
     * @var \Oxind\DashboardBundle\Entity\Vote 
     */
    protected $obVotes;

    /**
     *
     * @var \Oxind\DashboardBundle\Entity\Feedback 
     */
    protected $obFeedback;

    /**
     *
     * @var \Oxind\UserBundle\Entity\User
     */
    protected $obUser;

    /**
     * Function to setUp required configurations
     */
    public function setUp()
    {
        parent::setUp();
        $this->obVoteManager = $this->getManager('oxind_feedback.manager.default.vote');
        $obFeedback = $this->getManager('oxind_feedback.manager.feedback.default');
        $this->obFeedback = $obFeedback->findFeedbackById(1);
        $this->obUser = $this->obFeedback->getUser();
    }

    /**
     * Function to test findVoteBy method
     */
    public function testfindVoteBy()
    {
        $obVotes = $this->obVoteManager->findVoteBy(array('feedback' => 2));
        $this->assertTrue(count($obVotes) > 0);
        $this->assertTrue(is_object($obVotes));
    }

    /**
     * Function to test findVotesBy method
     */
    public function testfindVotesBy()
    {
        $obVotes = $this->obVoteManager->findVotesBy(array('feedback' => 2));
        $this->assertTrue(count($obVotes) > 0);
        $this->assertTrue(is_array($obVotes));
    }

    /**
     * Function to test findVotesByFeedback method
     */
    public function testfindVotesByFeedback()
    {
        $obVotes = $this->obVoteManager->findVotesByFeedback($this->obFeedback);
        $this->assertTrue(count($obVotes) > 0);
        $this->assertTrue(is_array($obVotes));
    }

    /**
     * Function to test getClass Method
     */
    public function testGetClass()
    {
        $ssClass = $this->obVoteManager->getClass();
        $this->assertEquals('Oxind\FeedbackBundle\Entity\Vote', $ssClass);
    }

    /**
     * Function to test saveVote method
     */
    public function testsaveVote()
    {
        $this->obVoteManager->saveVote($this->obVotes);
    }

    public function setVoteValues()
    {
        $this->obVotes = new \Oxind\DashboardBundle\Entity\Vote();
        $this->obVotes->setPoints(3);
        $this->obVotes->setFeedback($this->obFeedback);
        $this->obVotes->setUser($this->obUser);
        return $this->obVotes;
    }

}