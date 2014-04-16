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

use Oxind\FeedbackBundle\Model\FeedbackInterface;
use Oxind\FeedbackBundle\Model\TimelineInterface;
use Oxind\FeedbackBundle\Model\FeedbackDisplayInterface;

/**
 * Description of FeedbackDisplayManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
abstract class FeedbackDisplayManager implements FeedbackDisplayManagerInterface
{

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\FeedbackInterface $feedback
     * @param \Oxind\FeedbackBundle\Model\TimelineInterface $timeline
     * @return \Oxind\FeedbackBundle\Model\FeedbackDisplayInterface
     */
    public function createFeedbackDisplay(FeedbackInterface $feedback, TimelineInterface $timeline)
    {
        $class = $this->getClass();
        $feedbackDisplay = new $class();
        $feedbackDisplay->setFeedback($feedback);
        $feedbackDisplay->setTimeline($timeline);
        return $feedbackDisplay;
    }

    /**
     * 
     * @param integer $id
     * @return object
     */
    public function findFeedbackDisplayById($id)
    {
        return $this->findFeedbackDisplayBy(array('id' => $id));
    }

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\FeedbackDisplayInterface $feedbackDisplay
     * @throws \InvalidArgumentException
     */
    public function saveFeedbackDisplay(FeedbackDisplayInterface $feedbackDisplay)
    {
        if (null === $feedbackDisplay->getFeedback())
        {
            throw new \InvalidArgumentException('Feedback not Setted');
        }

        $this->doSaveFeedbackDisplay($feedbackDisplay);
    }

    /**
     * Performs the persistence of a feedbackDisplay.
     *
     * @abstract
     * @param FeedbackDisplayInterface $feedbackDisplay
     */
    abstract protected function doSaveFeedbackDisplay(FeedbackDisplayInterface $feedbackDisplay);
}
