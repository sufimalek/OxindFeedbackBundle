<?php

namespace Oxind\FeedbackBundle\Entity;

use Oxind\FeedbackBundle\Model\Manager\FeedbackTypeManager as BaseFeedbackTypeManager;
use Oxind\FeedbackBundle\Model\FeedbackTypeInterface;

/**
 * Description of FeedbackTypeManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
class FeedbackTypeManager extends BaseFeedbackTypeManager
{
    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\FeedbackTypeInterface $feedbackType
     */
    protected function doSaveFeedbackType(FeedbackTypeInterface $feedbackType)
    {
        $this->em->persist($feedbackType);
        $this->em->flush();
    }

    /**
     * 
     * @param array $criteria
     * @return type
     */
    public function findFeedbackTypeBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * Returns the fully qualified feedbackType class name
     *
     * @return string
     **/
    public function getClass()
    {
        return $this->class;
    }

}
