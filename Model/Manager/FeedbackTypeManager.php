<?php

namespace Oxind\FeedbackBundle\Model\Manager;

use Oxind\FeedbackBundle\Model\FeedbackTypeInterface;

/**
 * Description of FeedbackTypeManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
abstract class FeedbackTypeManager implements FeedbackTypeManagerInterface
{

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\FeedbackTypeInterface $feedbackType
     * @param integer $voteMinpoint
     * @param integer $voteMaxpoint
     * @return \Oxind\FeedbackBundle\Model\FeedbackTypeInterface
     */
    public function createFeedbackType(FeedbackTypeInterface $feedbackType, $voteMinpoint, $voteMaxpoint)
    {
        $class = $this->getClass();
        $objFeedbackType = new $class();
        $objFeedbackType->setVoteMinPoint($voteMinpoint);
        $objFeedbackType->setVoteMinPoint($voteMinpoint);

        return $objFeedbackType;
    }

    /**
     * 
     * @param integer $id
     * @return object
     */
    public function findFeedbackTypeById($id)
    {
        return $this->findFeedbackTypeBy(array('id' => $id));
    }

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\FeedbackTypeInterface $feedbackType
     * @throws \InvalidArgumentException
     */
    public function saveFeedbackType(FeedbackTypeInterface $feedbackType)
    {
        if (null === $feedbackType->getName()) {
            throw new \InvalidArgumentException('In FeedbackType name must not null');
        }

        $this->doSaveFeedbackType($feedbackType);
    }
    
    public function createFeedbackTypeObj()
    {
        $class = $this->getClass();
        $objFeedbackType = new $class();
    }

    /**
     * Performs the persistence of a feedback.
     *
     * @abstract
     * @param FeedbackInterface $feedback
     */
    abstract protected function doSaveFeedbackType(FeedbackTypeInterface $feedbackType);

}
