<?php

namespace Oxind\FeedbackBundle\Entity;

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Doctrine\ORM\EntityManager;
use Oxind\FeedbackBundle\Model\Manager\FeedbackManager as BaseFeedbackManager;
use Oxind\FeedbackBundle\Model\FeedbackInterface;
use Oxind\FeedbackBundle\Model\FeedbackTypeInterface;

/**
 * Description of FeedbackManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>, Hardik Patel <hpatel@oxind.com>
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

    /**
     * Function to save values in database
     * @param \Oxind\FeedbackBundle\Model\FeedbackInterface $feedback
     */
    protected function doSaveFeedback(FeedbackInterface $feedback)
    {
        $this->em->persist($feedback);
        $this->em->flush();
    }

    /**
     * 
     * @param integer $feedbacktype_id
     * @param array $asParams
     * @return array
     */
    public function findFeedbackByQuery(array $asParams)
    {
        $repo = $this->em->getRepository($this->class);
        $qb = $repo->createQueryBuilder('f');
        if ($asParams != '' && sizeof($asParams))
        {
            if (isset($asParams['feedbacktype_id']))
                $qb->andWhere('f.feedbackType = :feedbackType')->setParameter('feedbackType', $asParams['feedbacktype_id']);

            if (isset($asParams['statuses']) && $asParams['statuses'] != '')
                $qb->andWhere('f.status = :status')->setParameter('status', $asParams['statuses']);

            if (isset($asParams['title']))
                $qb->andWhere('f.title LIKE :query')->setParameter('query', '%' . $asParams['title'] . '%');
        }
        return $qb->getQuery()->getResult();
    }

    /**
     * Function to find data by feedback id
     * @param array $feedbacks
     * @return array
     */
    protected function findByFeedbackId(array $feedbacks)
    {
        foreach ($feedbacks as $key => $feedback)
        {
            if ($feedback->getFeedbackType()->getId() != $feedbacktype_id)
            {
                unset($feedbacks[$key]);
            }
        }
        return $feedbacks;
    }

    /**
     * Function to find feedback by criteria
     * @param array $criteria
     * @return type
     */
    public function findFeedbackBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * Function to find data by criteria
     * @param array $criteria
     * @return type
     */
    public function findFeedbacksBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    /**
     * Function to find data by status
     * @param type $status
     * @return type
     */
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

    /**
     * Function to find data by types
     * @param \Oxind\FeedbackBundle\Model\FeedbackTypeInterface $feedbacktype
     * @return type
     */
    public function findFeedbacksByFeedbackType(FeedbackTypeInterface $feedbacktype)
    {
        return $this->findFeedbacksBy(array('feedbackType' => $feedbacktype));
    }

}
