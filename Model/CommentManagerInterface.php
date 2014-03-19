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
interface CommentManagerInterface
{
    /**
     * Returns the class of the Comment object.
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
     * @return \Oxind\FeedbackBundle\Model\CommentInterface $comment
     */
    public function createComment($title,$description, $userId, $status );
    
    /**
     * Persists a comment.
     *
     * @param  CommentInterface $comment
     * @return void
     */
    public function saveComment(CommentInterface $comment);
    
    /**
     * Finds a comment by specified criteria.
     *
     * @param  array $criteria
     * @return CommentInterface
     */
    public function findCommentBy(array $criteria);
            
    /**
     * Finds a comment by id.
     *
     * @param  $id
     * @return CommentInterface
     */
    public function findCommentById($id);
}
