<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Oxind\FeedbackBundle\Model;

use Oxind\FeedbackBundle\Model\IssueInterface;

/**
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
interface IssueMangerInterface
{
    
    /**
     * Returns the class of the Issue object.
     *
     * @return string
     */
    public function getClass();
    
    /**
     * 
     * @param string $title
     * @param string $description
     * @param integer $userId
     * @param integer $status
     * @return \Oxind\FeedbackBundle\Model\IssueInterface $issue
     */
    public function createIssue($title,$description, $userId, $status );
    
    /**
     * Persists a issue.
     *
     * @param  IssueInterface $issue
     * @return void
     */
    public function saveIssue(IssueInterface $issue);
    
    /**
     * Finds a issue by specified criteria.
     *
     * @param  array $criteria
     * @return IssueInterface
     */
    public function findIssueBy(array $criteria);
            
    /**
     * Finds a issue by id.
     *
     * @param  $id
     * @return IssueInterface
     */
    public function findIssueById($id);
    
}
