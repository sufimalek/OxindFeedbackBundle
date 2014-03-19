<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Oxind\FeedbackBundle\Entity;

use Doctrine\ORM\EntityManager;
use Oxind\FeedbackBundle\Model\SuggestionIterface;
use Oxind\FeedbackBundle\Model\SuggestionManager as BaseSuggestionManager;

/**
 * Description of IsseuManger
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
class SuggestionManager extends BaseSuggestionManager
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

    public function doSaveSuggestion(SuggestionIterface $suggestion)
    {
        $this->em->persist($suggestion);
        $this->em->flush();
    }

    public function findSuggestionBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    public function findSuggestionsBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }
}
