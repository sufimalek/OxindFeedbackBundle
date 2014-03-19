<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Oxind\FeedbackBundle\Model;

/**
 * Description of Suggestion
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
abstract class Suggestion implements SuggestionIterface
{
    protected $id;
    protected $userId;
    protected $title;
    protected $description;
    protected $status;
    
    public function getDescription()
    {
        return $this->description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getUserId()
    {
        return $this->userId;
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

}
