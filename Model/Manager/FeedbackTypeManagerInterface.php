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
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
interface FeedbackTypeManagerInterface
{

    /**
     * Returns the class of the FeedbackType object.
     *
     * @return string
     */
    public function getClass();

    /**
     * 
     * @param string  $feedbackType
     * @param integer  $voteMinpoint
     * @param integer  $voteMaxpoint
     * @return \Oxind\FeedbackBundle\Model\FeedbackTypeInterface $feedbackType
     */
    public function createFeedbackType(FeedbackTypeInterface $feedbackType, $voteMinpoint, $voteMaxpoint);

    /**
     * Persists a feedbackType.
     *
     * @param  FeedbackTypeInterface $feedbackType
     * @return void
     */
    public function saveFeedbackType(FeedbackTypeInterface $feedbackType);

    /**
     * Finds a feedbackType by specified criteria.
     *
     * @param  array $criteria
     * @return FeedbackTypeInterface
     */
    public function findFeedbackTypeBy(array $criteria);

    /**
     * Finds a feedbackType by id.
     *
     * @param  $id
     * @return Feedbacknterface
     */
    public function findFeedbackTypeById($id);
}
