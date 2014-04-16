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

use Oxind\FeedbackBundle\Model\FeedbackType as AbstractFeedbackType;

/**
 * Description of FeedbackType
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
class FeedbackType extends AbstractFeedbackType
{

    public function getDefaultStatus()
    {
        return $this->getStatuses()[0];
    }

}
