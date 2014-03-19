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
interface SuggestionManagerInterface
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
     * @return \Oxind\FeedbackBundle\Model\SuggestionIterface $suggestion
     */
    public function createSuggestion($title,$description, $userId, $status );
    
    /**
     * Persists a issue.
     *
     * @param  SuggestionIterface $suggestion
     * @return void
     */
    public function saveSuggestion(SuggestionIterface $suggestion);
    
    /**
     * Finds a issue by specified criteria.
     *
     * @param  array $criteria
     * @return SuggestionIterface
     */
    public function findSuggestionBy(array $criteria);
            
    /**
     * Finds a issue by id.
     *
     * @param  $id
     * @return SuggestionIterface
     */
    public function findSuggestionById($id);
    
}
