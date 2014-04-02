<?php
namespace Oxind\FeedbackBundle\Entity;

use Oxind\FeedbackBundle\Model\FeedbackType as AbstractFeedbackType;
/**
 * Description of FeedbackType
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
class FeedbackType extends AbstractFeedbackType
{
    public function getDefaultStatusIndex()
    {
        return 0;
    }
    
    /**
     * return array containing index of displayable statuses.
     * @return array
     */
    public function getDisplayableStatusesIndex()
    {
        return array();
    }
}
