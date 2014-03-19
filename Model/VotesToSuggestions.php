<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Oxind\FeedbackBundle\Model;

/**
 * Description of VotesToSuggestions
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
class VotesToSuggestions implements VotesToSuggestionsInterface
{

    protected $userId;
    
    protected $suggestionId;
    
    protected $points;


    public function getPoints()
    {
        return $this->points;
    }

    public function getSuggestionId()
    {
        return $this->suggestionId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setPoints($points)
    {
        $this->points = $points;
    }

    public function setSuggestionId($suggestionId)
    {
        $this->suggestionId = $suggestionId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

}
