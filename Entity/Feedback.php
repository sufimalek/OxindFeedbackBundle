<?php

namespace Oxind\FeedbackBundle\Entity;

use Oxind\FeedbackBundle\Model\Feedback as AbstractFeedback;

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
}
