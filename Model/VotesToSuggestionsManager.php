<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Oxind\FeedbackBundle\Model;
/**
 * Description of VotesToSuggestionsManger
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
abstract class VotesToSuggestionsManager implements VotesToSuggestionsManagerInterface
{
    public function createVote($userId, $suggestionId, $vote)
    {
        $class = $this->getClass();
        
        $voteToSuggstion = new $class();
        $voteToSuggstion->setUserId($userId);
        $voteToSuggstion->setSuggestionId($suggestionId);
        $voteToSuggstion->setSuggestionId($suggestionId);
        $voteToSuggstion->setVote($vote);

        return $voteToSuggstion;
    }

    public function saveVote(VotesToSuggestionsInterface $vote)
    {
         if (null === $vote->getUserId())
        {
            throw new \InvalidArgumentException('UserId passed into saveVote must have a UserId');
        } 
        else if (null === $vote->getPoints())
        {
            throw new \InvalidArgumentException('Points passed into saveVote must have a Points');
        }
        else if (null === $vote->getSuggestionId())
        {
            throw new \InvalidArgumentException('SuggestionId passed into saveVote must have a SuggestionId');
        }
        
        $this->doSaveVote($vote);
    }
    
    abstract protected function doSaveVote(VotesToSuggestionsInterface $vote);
}
