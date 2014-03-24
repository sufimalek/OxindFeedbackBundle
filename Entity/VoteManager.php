<?php

namespace Oxind\FeedbackBundle\Entity;

use Oxind\FeedbackBundle\Model\Manager\VoteManager as BaseVoteManager;
use Oxind\FeedbackBundle\Model\FeedbackInterface;
use Oxind\FeedbackBundle\Model\VoteInterface;

/**
 * Description of VoteManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
class VoteManager extends BaseVoteManager
{
    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\VoteInterface $vote
     */
    protected function doSaveVote(VoteInterface $vote)
    {
        $this->em->persist($vote);
        $this->em->flush();
    }

    /**
     * 
     * @param array $criteria
     * @return type
     */
    public function findVoteBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\FeedbackInterface $feedback
     */
    public function findVotesByfindFeedback(FeedbackInterface $feedback)
    {
        
    }

    /**
     * Returns the fully qualified vote class name
     *
     * @return string
     **/
    public function getClass()
    {
        return $this->class;
    }

}
