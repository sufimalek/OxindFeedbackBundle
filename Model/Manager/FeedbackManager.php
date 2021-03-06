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

use Oxind\FeedbackBundle\Model\FeedbackInterface;
use Oxind\FeedbackBundle\Model\FeedbackTypeInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of FeedbackManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
abstract class FeedbackManager implements FeedbackManagerInterface
{

    /**
     * 
     * @param string $title
     * @param string $content
     * @param \Oxind\FeedbackBundle\Model\FeedbackTypeInterface $feedbackType
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     * @return \Oxind\FeedbackBundle\Model\Manager\class
     */
    public function createFeedback($title, $content, FeedbackTypeInterface $feedbackType, UserInterface $user)
    {
        $class = $this->getClass();
        $feedback = new $class();
        $feedback->setTitle($title);
        $feedback->setContent($content);
        $feedback->setFeedbackType($feedbackType);

        $feedback->setUser($user);

        return $feedback;
    }

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\FeedbackInterface $feedback
     * @throws \InvalidArgumentException
     */
    public function saveFeedback(FeedbackInterface $feedback)
    {
        if (null === $feedback->getFeedbackType())
        {
            throw new \InvalidArgumentException('FeedbackType not passed into Feedback');
        }

        $this->doSaveFeedback($feedback);
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function findFeedbackById($id)
    {
        return $this->findFeedbackBy(array('id' => $id));
    }

    /**
     * Performs the persistence of a feedback.
     *
     * @abstract
     * @param FeedbackInterface $feedback
     */
    abstract protected function doSaveFeedback(FeedbackInterface $feedback);
}
