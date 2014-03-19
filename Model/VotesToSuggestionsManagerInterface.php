<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Oxind\FeedbackBundle\Model;

use Oxind\FeedbackBundle\Model\VotesToSuggestionsInterface;

/**
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
interface VotesToSuggestionsManagerInterface
{
    /**
     * Returns the class of the VotesToSuggestions object.
     *
     * @return string
     */
    public function getClass();
    
    /**
     * 
     * @param integer $userId
     * @param integer $suggestionId
     * @param integer $vote
     * @return \Oxind\FeedbackBundle\Model\VotesToSuggestionsInterface $voteToSuggstion
     */
    public function createVote($userId,$suggestionId, $vote);
    
    /**
     * Persists a voteToSuggstion.
     *
     * @param  VotesToSuggestionsInterface $voteToSuggstion
     * @return void
     */
    public function saveVote(VotesToSuggestionsInterface $voteToSuggstion);
    
    /**
     * Finds a voteToSuggstion by specified criteria.
     *
     * @param  array $criteria
     * @return SuggestionInterface
     */
    public function findVoteBy(array $criteria);
            
}
