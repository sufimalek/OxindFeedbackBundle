<?php

namespace Oxind\FeedbackBundle\Model;

/**
 * Description of IssueManger
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
abstract class IssueManger implements IssueMangerInterface
{
    public function createIssue($title, $description, $userId, $status)
    {
        $class = $this->getClass();
        
        /* @var Oxind\FeedbackBundle\Model\IssueInterface $issue */
        $issue = new $class();
        $issue->setTitle($title);
        $issue->setDescription($description);
        $issue->setUserId($userId);
        $issue->setStatus($status);
        
        return $issue;
    }

    public function findIssueById($id)
    {
        return $this->findIssueBy(array('id' => $id));
    }
    
    public function saveIssue(IssueInterface $issue)
    {
        if (null === $issue->getTitle())
        {
            throw new \InvalidArgumentException('Title passed into saveIssue must have a Ttitle');
        } 
        else if (null === $issue->getDescription())
        {
            throw new \InvalidArgumentException('Description passed into saveIssue must have a Description');
        }
        else if (null === $issue->getUserId())
        {
            throw new \InvalidArgumentException('UserId passed into saveIssue must have a UserId');
        }
        
        $this->doSaveIssue($issue);
    }
    
    /**
     * Performs the persistence of the Issue.
     *
     * @abstract
     * @param IssueInterface $issue
     */
    abstract public function doSaveIssue(IssueInterface $issue);
}
