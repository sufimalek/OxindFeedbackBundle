<?php

namespace Oxind\FeedbackBundle\Model;

/**
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
interface IssueInterface
{
    // Getters
    
    /**
     * @return integer
     */
    public function getId();
    
    /**
     * @return integer
     */
    public function getUserId();
    
    /**
     * @return String $title
     */
    public function getTitle();
    
    /**
     * @return string $description
     */
    public function getDescription();
    
    /**
     * @return integer $status
     */
    public function getStatus();
    
    // Setters
    
    /**
     * @param integer $userId 
     */
    public function setUserId($userId);
    
    /**
     * @param string $title
     */
    public function setTitle($title);
    
    /**
     * @param string $description
     */
    public function setDescription($description);
    
    /**
     * @param integer $status
     */
    public function setStatus($status);
    
}
