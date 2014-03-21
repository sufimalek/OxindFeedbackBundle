<?php

namespace Oxind\FeedbackBundle\Model\Manager;

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
