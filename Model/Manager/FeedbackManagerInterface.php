<?php

namespace Oxind\FeedbackBundle\Model\Manager;

use Oxind\FeedbackBundle\Model\FeedbackInterface;
use Oxind\FeedbackBundle\Model\FeedbackTypeInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */

interface FeedbackManagerInterface
{
    /**
     * Returns the class of the Feedback object.
     *
     * @return string
     */
    public function getClass();
    
    /**
     * 
     * @param string $title
     * @param string $content
     * @param \Oxind\FeedbackBundle\Model\FeedbackTypeInterface $feedbackType
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     * @return \Oxind\FeedbackBundle\Model\Manager\class
     */
    public function createFeedback( $title,$content,FeedbackTypeInterface $feedbackTypeId, UserInterface $user);
    
    /**
     * Persists a feedback.
     *
     * @param  FeedbackInterface $feedback
     * @return void
     */
    public function saveFeedback(FeedbackInterface $feedback);
    
    /**
     * Finds a feedback by specified criteria.
     *
     * @param  array $criteria
     * @return FeedbackInterface
     */
    public function findFeedbackBy(array $criteria);
            
    /**
     * Finds a feedback by id.
     *
     * @param  $id
     * @return Feedbacknterface
     */
    public function findFeedbackById($id);
}
