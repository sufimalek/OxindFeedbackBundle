<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Oxind\FeedbackBundle\Model;

/**
 * Description of SuggestionManager
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
abstract class SuggestionManager implements SuggestionManagerInterface
{
    
    public function createSuggestion($title, $description, $userId, $status)
    {
        $class = $this->getClass();
        
        $suggestion = new $class();
        $suggestion->setTitle($title);
        $suggestion->setDescription($description);
        $suggestion->setUserId($userId);
        $suggestion->setStatus($status);
        
        return $suggestion;
    }

    public function findSuggestionById($id)
    {
        return $this->findSuggestionBy(array('id'=>$id));
    }

    public function saveSuggestion(SuggestionIterface $suggestion)
    {
        if (null === $suggestion->getTitle())
        {
            throw new \InvalidArgumentException('Title passed into saveSuggestion must have a Ttitle');
        } 
        else if (null === $suggestion->getDescription())
        {
            throw new \InvalidArgumentException('Description passed into saveSuggestion must have a Description');
        }
        else if (null === $suggestion->getUserId())
        {
            throw new \InvalidArgumentException('UserId passed into saveSuggestion must have a UserId');
        }
        
        $this->doSaveIssue($suggestion);
    }

    /**
     * Performs the persistence of the Suggestion.
     *
     * @abstract
     * @param SuggestionIterface $issue
     */
    abstract public function doSaveSuggestion(SuggestionIterface $suggestion);
}
