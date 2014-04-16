<?php

namespace Oxind\FeedbackBundle\Entity;

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        return (in_array($this->getStatus(), $arrDisplayableStatus));
    }

    /**
     * Function to check votes for users
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     * @return boolean
     */
    public function hasUserVoted(UserInterface $user)
    {
        $votes = $this->getVotes();
        if ($votes != null && count($votes) > 0)
        {
            foreach ($votes as $vote)
            {
                if ($vote->getUser()->getId() == $user->getId())
                {
                    return true;
                }
            }
        }

        return false;
    }

}
