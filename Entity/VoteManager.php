<?php

namespace Oxind\FeedbackBundle\Entity;

use Oxind\FeedbackBundle\Model\Manager\VoteManager as BaseVoteManager;
use Oxind\FeedbackBundle\Model\FeedbackInterface;
use Oxind\FeedbackBundle\Model\VoteInterface;
use Doctrine\ORM\EntityManager;

/**
 * Description of VoteManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
class VoteManager extends BaseVoteManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $class;

    /**
     * Constructor.
     *
     * @param \Doctrine\ORM\EntityManager $em
     * @param string $class
     */
    public function __construct(EntityManager $em, $class)
    {
        var_dump($class);die;
        $this->em = $em;
        $this->repository = $em->getRepository($class);

        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
    }
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
     * @param array $criteria
     * @return type
     */
    public function findVotesBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\FeedbackInterface $feedback
     */
    public function findVotesByFeedback(FeedbackInterface $feedback)
    {
        return $this->findVotesBy( array( 'feedback_id' => $feedback->getId() ));
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
