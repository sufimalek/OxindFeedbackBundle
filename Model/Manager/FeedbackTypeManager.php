<?php

namespace Oxind\FeedbackBundle\Model\Manager;

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Oxind\FeedbackBundle\Model\FeedbackTypeInterface;

/**
 * Description of FeedbackTypeManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
abstract class FeedbackTypeManager implements FeedbackTypeManagerInterface
{

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\FeedbackTypeInterface $feedbackType
     * @param integer $voteMinpoint
     * @param integer $voteMaxpoint
     * @return \Oxind\FeedbackBundle\Model\FeedbackTypeInterface
     */
    public function createFeedbackType(FeedbackTypeInterface $feedbackType, $voteMinpoint, $voteMaxpoint)
    {
        $class = $this->getClass();
        $objFeedbackType = new $class();
        $objFeedbackType->setVoteMinPoint($voteMinpoint);
        $objFeedbackType->setVoteMinPoint($voteMinpoint);

        return $objFeedbackType;
    }

    /**
     * 
     * @param integer $id
     * @return object
     */
    public function findFeedbackTypeById($id)
    {
        return $this->findFeedbackTypeBy(array('id' => $id));
    }

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\FeedbackTypeInterface $feedbackType
     * @throws \InvalidArgumentException
     */
    public function saveFeedbackType(FeedbackTypeInterface $feedbackType)
    {
        if (null === $feedbackType->getName())
        {
            throw new \InvalidArgumentException('In FeedbackType name must not null');
        }

        $this->doSaveFeedbackType($feedbackType);
    }

    /**
     * Performs the persistence of a feedback.
     *
     * @abstract
     * @param FeedbackInterface $feedback
     */
    abstract protected function doSaveFeedbackType(FeedbackTypeInterface $feedbackType);
}
