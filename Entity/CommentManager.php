<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Oxind\FeedbackBundle\Entity;

use Doctrine\ORM\EntityManager;
use Oxind\FeedbackBundle\Model\CommentInterface;
use Oxind\FeedbackBundle\Model\CommentManager as BaseCommentManager;

/**
 * Description of IsseuManger
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
class CommentManager extends BaseCommentManager
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

    public function getClass()
    {
        return $this->class;
    }

    public function doSaveComment(CommentInterface $comment)
    {
        $this->em->persist($comment);
        $this->em->flush();
    }

    public function findCommentsBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    public function findCommentBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

}