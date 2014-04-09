<?php

namespace Oxind\FeedbackBundle\Entity;

use Oxind\FeedbackBundle\Model\Feedback as AbstractFeedback;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Description of Feedback
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
class Feedback extends AbstractFeedback
{
 
    /**
     * 
     * @return string
     */
    public function getAuthorName()
    {
        return 'Anonymous';
    }
    
    /**
     * 
     * @return boolean
     */
    public function isDisplayable()
    {
        $arrDisplayableStatus = $this->getFeedbackType()->getDisplayableStatuses();
        return  (in_array( $this->getStatus() , $arrDisplayableStatus));
    }
    
    public function hasUserVoted(UserInterface $user)
    {
        $votes = $this->getVotes();
        if($votes != null && count($votes)>0)
        {
            foreach ($votes as $vote)
            {
                if($vote->getUser()->getId() == $user->getId())
                {
                    return true;
                }
            }
        }
        
        return false;
    }
}
