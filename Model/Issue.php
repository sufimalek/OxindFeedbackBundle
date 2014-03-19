<?php

namespace Oxind\FeedbackBundle\Model;

/**
 * Description of Issue
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
class Issue implements IssueInterface
{
    protected $id;
    protected $userId;
    protected $title;
    protected $description;
    protected $status;
    protected $createdAt;
    protected $updatedAt;

    public function getDescription()
    {
        return $this->description;
    }

    public function getId()
    {
        $this->getId();
    }

    public function getStatus()
    {
        $this->status;
    }

    public function getTitle()
    {
        $this->title;
    }

    public function getUserId()
    {
        $this->userId;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }


}
