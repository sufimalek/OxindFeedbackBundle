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
    public function getAuthorName()
    {
        return 'Anonymous';
    }
}
