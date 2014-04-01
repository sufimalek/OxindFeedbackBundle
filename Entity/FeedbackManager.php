<?php

namespace Oxind\FeedbackBundle\Entity;

use Doctrine\ORM\EntityManager;
use Oxind\FeedbackBundle\Model\Manager\FeedbackManager as BaseFeedbackManager;
use Oxind\FeedbackBundle\Model\FeedbackInterface;
use Oxind\FeedbackBundle\Model\FeedbackTypeInterface;

/**
 * Description of FeedbackManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
class FeedbackManager extends BaseFeedbackManager
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
    
    protected function doSaveFeedback(FeedbackInterface $feedback)
    {
        $this->em->persist($feedback);
        $this->em->flush();
    }

    /**
     * 
     * @param integer $feedbacktype_id
     * @param string $q
     * @return array
     */
    public function findFeedbackByQuery($q)
    {
        $repo = $this->em->getRepository($this->class);
        $qb = $repo->createQueryBuilder('f')
                ->where('f.title LIKE :query')
                ->setParameter('query', '%'.$q.'%')
                ->getQuery()
                ->getResult();
        
        return $qb;
    }
    
    protected function findByFeedbackId(array $feedbacks)
    {
        foreach($feedbacks as $key=>$feedback)
        {
            if($feedback->getFeedbackType()->getId() != $feedbacktype_id)
            {
                unset($feedbacks[$key]);
            }
        }
        return $feedbacks;
    }

    public function findFeedbackBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    public function findFeedbacksBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    public function findFeedbacksByStatus($status)
    {
        return $this->findFeedbacksBy(array('status' => $status));
    }

    /**
     * Returns the fully qualified feedback class name
     *
     * @return string
     * */
    public function getClass()
    {
        return $this->class;
    }

    
    /**
     * 
     * @return array
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }
    
    public function findFeedbacksByFeedbackType(FeedbackTypeInterface $feedbacktype)
    {
        return $this->findFeedbacksBy(array('feedbackType' => $feedbacktype));
    }

}
