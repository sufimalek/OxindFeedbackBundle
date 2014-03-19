<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Oxind\FeedbackBundle\Model;

use Oxind\FeedbackBundle\Model\CommentInterface;

/**
 * Description of CommentManger
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
abstract class CommentManager implements CommentManagerInterface
{
    public function createComment($title, $description, $userId, $status)
    {
        $class = $this->getClass();
        
        $comment = new $class();
        $comment->setTitle($title);
        $comment->setDescription($description);
        $comment->setUserId($userId);
        $comment->setStatus($status);
        
        return $comment;
    }

    public function findCommentById($id)
    {
        return $this->findIssueBy(array('id' => $id));
    }
    
    public function saveComment(CommentInterface $comment)
    {
        if (null === $comment->getTitle())
        {
            throw new \InvalidArgumentException('Title passed into saveComment must have a Ttitle');
        } 
        else if (null === $comment->getDescription())
        {
            throw new \InvalidArgumentException('Description passed into saveComment must have a Description');
        }
        else if (null === $comment->getUserId())
        {
            throw new \InvalidArgumentException('UserId passed into saveComment must have a UserId');
        }
        
        $this->doSaveComment($comment);
    }
    
    /**
     * Performs the persistence of the Comment.
     *
     * @abstract
     * @param CommentInterface $comment
     */
    abstract public function doSaveComment(CommentInterface $comment);
}
