<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Oxind\FeedbackBundle\Entity;

use Doctrine\ORM\EntityManager;
use Oxind\FeedbackBundle\Model\IssueInterface;
use Oxind\FeedbackBundle\Model\IssueManger as BaseIssueManger;

/**
 * Description of IsseuManger
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
class IsseuManger extends BaseIssueManger
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
    
    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);
        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
    }
    
    
    public function doSaveIssue(IssueInterface $issue)
    {
        $this->em->persist($issue);
        $this->em->flush();
    }

    public function findIssuesBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }
    
    public function findIssueBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }
    
    public function findAllIssues()
    {
        return $this->repository->findAll();
    }

    public function getClass()
    {
        return $this->class;
    }

//put your code here
}
