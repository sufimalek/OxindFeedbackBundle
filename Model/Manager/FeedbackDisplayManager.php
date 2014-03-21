<?php

namespace Oxind\FeedbackBundle\Model\Manager;

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
     * @param \DateTime $startDate
     * @param \DateTime $endtDate
     * @return \Oxind\FeedbackBundle\Model\FeedbackDisplayInterface
     */
    public function createFeedbackDisplay(FeedbackInterface $feedback, TimelineInterface $timeline, $startDate, $endtDate)
    {
        $feedback = new FeedbackDisplayInterface();
        $feedback->setFeedback($feedback);

        return $feedback;
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
        if (null === $feedbackDisplay->getFeedback()) {
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
