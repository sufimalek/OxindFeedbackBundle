<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Oxind\FeedbackBundle\Model;

/**
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
interface VotesToSuggestionsInterface
{
    public function getUserId();
    public function setUserId($userId);
    public function getSuggestionId();
    public function setSuggestionId($suggestionId);
    public function getPoints();
    public function setPoints($points);
}
