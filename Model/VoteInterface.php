<?php

namespace Oxind\FeedbackBundle\Model;

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\Security\Core\User\UserInterface;

interface VoteInterface
{

    /**
     * Set the value of points.
     *
     * @param integer $points
     * @return VoteInterface
     */
    public function setPoints($points);

    /**
     * Get the value of points.
     *
     * @return integer
     */
    public function getPoints();

    /**
     * Set Feedback entity (many to one).
     *
     * @param FeedbackInterface $feedback
     * @return VoteInterface
     */
    public function setFeedback(FeedbackInterface $feedback);

    /**
     * Get Feedback entity (many to one).
     *
     * @return FeedbackInterface
     */
    public function getFeedback();

    /**
     * Set User entity (many to one).
     *
     * @param UserInterface $user
     * @return VoteInterface
     */
    public function setUser(UserInterface $user);

    /**
     * Get User entity (many to one).
     *
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUser();
}