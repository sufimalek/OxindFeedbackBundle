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
 * Description of FeedbackDisplayManagerTest
 *
 * @author Hardik Patel <hpatel@oxind.com>
 */
class FeedbackDisplayManagerTest extends OxindWebTestCase
{

    /**
     *
     * @var \Oxind\FeedbackBundle\Entity\FeedbackDisplayManager 
     */
    protected $obFeedbackDisplay;

    /**
     * Function to setUp required configurations
     */
    public function setUp()
    {
        parent::setUp();
        $this->obFeedbackDisplay = $this->getManager('oxind_feedback.manager.feedbackdisplay.default');
    }

    /**
     * Function to test findFeedbackDisplayBy method
     */
    public function testfindFeedbackDisplayBy()
    {
        $obFeedbackDisplay = $this->obFeedbackDisplay->findFeedbackDisplayBy(array('feedback' => '1'));
        $this->assertTrue(count($obFeedbackDisplay) > 0);
        $this->assertTrue(is_object($obFeedbackDisplay));
    }

    /**
     * Function to test getClass Method
     */
    public function testGetClass()
    {
        $ssClass = $this->obFeedbackDisplay->getClass();        
        $this->assertEquals('Oxind\FeedbackBundle\Entity\FeedbackDisplay', $ssClass);
    }

}

