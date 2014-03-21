<?php

namespace Oxind\FeedbackBundle\Model\Manager;

use Oxind\FeedbackBundle\Model\FeedbackInterface;
use Oxind\FeedbackBundle\Model\FeedbackTypeInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of FeedbackManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */

abstract class FeedbackManager implements FeedbackManagerInterface
{
    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\FeedbackInterface $feedback
     * @param \Oxind\FeedbackBundle\Model\FeedbackTypeInterface $feedbackType
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     * @return \Oxind\FeedbackBundle\Model\Manager\class
     */
    public function createFeedback(FeedbackInterface $feedback, FeedbackTypeInterface $feedbackType, UserInterface $user)
    {
        //$class = $this->getClass();
        $feedback = new FeedbackInterface();
        $feedback->setFeedbackType($feedbackType);

        return $feedback;
    }    

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\FeedbackInterface $feedback
     * @throws \InvalidArgumentException
     */
    public function saveFeedback(FeedbackInterface $feedback)
    {
        if (null === $feedback->getFeedbackType()) {
            throw new \InvalidArgumentException('FeedbackType not passed into Feedback');
        }

        $this->doSaveFeedback($feedback);
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function findFeedbackById($id)
    {
        return $this->findFeedbackBy(array('id' => $id));
    }
    
    /**
     * Performs the persistence of a feedback.
     *
     * @abstract
     * @param FeedbackInterface $feedback
     */
    abstract protected function doSaveFeedback(FeedbackInterface $feedback);
    
}
