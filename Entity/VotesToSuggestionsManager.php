<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Oxind\FeedbackBundle\Entity;

use Doctrine\ORM\EntityManager;
use Oxind\FeedbackBundle\Model\VotesToSuggestionsInterface;
use Oxind\FeedbackBundle\Model\VotesToSuggestionsManager as BaseVotesToSuggestionsManager;

/**
 * Description of IsseuManger
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
class VotesToSuggestionsManager extends BaseVotesToSuggestionsManager
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

    protected function doSaveVote(VotesToSuggestionsInterface $vote)
    {
        $this->em->persist($vote);
        $this->em->flush();
    }

    public function findVoteBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

}