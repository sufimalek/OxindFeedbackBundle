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
        return $this->findVotesBy( array( 'feedback' => $feedback->getId() ));
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
    
    public function getVoteTotalPoints()
    {
        $qb =$this->repository->createQueryBuilder('v')
                ->select('v,SUM(v.points) as totalpoint')
                ->groupBy('v.feedback');
        
        $resultset = $qb->getQuery()->getResult();
        $arrResult = array();
        
        foreach($resultset as $result)
        {
            $vote = $result[0];
            $feedback = $vote->getFeedback();
            if ($feedback !== null)
            {
                $arrResult[$feedback->getId()] = $result['totalpoint'];
            }
        } 
        
        return $arrResult;
    }
    
    public function creditVotePointsBack(FeedbackInterface $feedback)
    {
        $votes = $this->findVotesByFeedback($feedback);
        
        foreach($votes as $vote)
        {
            $votedPoints = $vote->getPoints();
            $userPoint = $vote->getUser()->getPoints();
            $userPoint += $votedPoints;
            $vote->getUser()->setPoints($userPoint);
            $this->em->persist($vote);
        }
        $this->em->flush();
    }
    
    public function findVoteByUserAndFeedback($user_id, $feedback_id)
    {
        $repo = $this->em->getRepository($this->class);
        $qb = $repo->createQueryBuilder('v')
                ->where('v.feedback = :feedback_id')
                ->andWhere('v.user = :user_id')
                ->setParameter('feedback_id', $feedback_id)
                ->setParameter('user_id', $user_id)
                ->getQuery()
                ->getResult();
        
        return $qb;
    }
}
