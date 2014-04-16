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

/**
 * Entity\Feedback
 *
 */
interface FeedbackInterface
{

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return FeedbackInterface
     */
    public function setId($id);

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId();

    /**
     * Set the value of title.
     *
     * @param string $title
     * @return FeedbackInterface
     */
    public function setTitle($title);

    /**
     * Get the value of title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set the value of content.
     *
     * @param string $content
     * @return FeedbackInterface
     */
    public function setContent($content);

    /**
     * Get the value of content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Set the value of status.
     *
     * @param string $status
     * @return FeedbackInterface
     */
    public function setStatus($status);

    /**
     * Get the value of status.
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set the value of created_at.
     *
     * @param  \DateTime $created_at
     * @return FeedbackInterface
     */
    public function setCreatedAt(\DateTime $created_at);

    /**
     * Get the value of created_at.
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set the value of updated_at.
     *
     * @param  \DateTime $updated_at
     * @return FeedbackInterface
     */
    public function setUpdatedAt(\DateTime $updated_at);

    /**
     * Get the value of updated_at.
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * Set the value of deleted_at.
     *
     * @param \DateTime $deleted_at
     * @return FeedbackInterface
     */
    public function setDeletedAt(\DateTime $deleted_at);

    /**
     * Get the value of deleted_at.
     *
     * @return \DateTime
     */
    public function getDeletedAt();

    /**
     * Add FeedbackDisplay entity to collection (one to many).
     *
     * @param FeedbackDisplayInterface $feedbackDisplay
     * @return FeedbackInterface
     */
    public function addFeedbackDisplay(FeedbackDisplayInterface $feedbackDisplay);

    /**
     * Get FeedbackDisplay entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeedbackDisplays();

    /**
     * Add Vote entity to collection (one to many).
     *
     * @param VoteInterface $vote
     * @return FeedbackInterface
     */
    public function addVote(VoteInterface $vote);

    /**
     * Get Vote entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVotes();

    /**
     * Set FeedbackType entity (many to one).
     *
     * @param FeedbackTypeInterface $feedbackType
     * @return FeedbackInterface
     */
    public function setFeedbackType(FeedbackTypeInterface $feedbackType);

    /**
     * Get FeedbackType entity (many to one).
     *
     * @return \Oxind\FeedbackBundle\Model\Interface\FeedbackTypeInterface
     */
    public function getFeedbackType();

    /**
     * Set User entity (many to one).
     *
     * @param \Symfony\Component\Security\Core\User\UserInterface
     * @return FeedbackInterface
     */
    public function setUser(UserInterface $user);

    /**
     * Get User entity (many to one).
     *
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUser();
}