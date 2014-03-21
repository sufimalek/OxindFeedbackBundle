<?php

namespace Oxind\FeedbackBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

abstract class Feedback implements FeedbackInterface
{
    /**
     *
     * @var integer 
     */
    protected $id;

    /**
     *
     * @var string 
     */
    protected $title;

    /**
     *
     * @var string 
     */
    protected $content;

    /**
     *
     * @var integer 
     */
    protected $status;

    /**
     *
     * @var \DateTime 
     */
    protected $created_at;

    /**
     *
     * @var \DateTime 
     */
    protected $updated_at;

    /**
     *
     * @var \DateTime 
     */
    protected $deleted_at;

    /**
     *
     * @var FeedbackDisplayInterface 
     */
    protected $feedbackDisplays;

    /**
     *
     * @var ArrayCollection 
     */
    protected $votes;

    protected $feedbackType;

    protected $user;

    public function __construct()
    {
        $this->feedbackDisplays = new ArrayCollection();
        $this->votes = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return Feedback
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of title.
     *
     * @param string $title
     * @return Feedback
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of content.
     *
     * @param string $content
     * @return Feedback
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of status.
     *
     * @param string $status
     * @return Feedback
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of created_at.
     *
     * @param  $created_at
     * @return Feedback
     */
    public function setCreatedAt(\DateTime $created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of created_at.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of updated_at.
     *
     * @param  \DateTime $updated_at
     * @return Feedback
     */
    public function setUpdatedAt(\DateTime $updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of updated_at.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of deleted_at.
     *
     * @param \DateTime $deleted_at
     * @return Feedback
     */
    public function setDeletedAt(\DateTime $deleted_at)
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }

    /**
     * Get the value of deleted_at.
     *
     * @return string
     */
    public function getDeletedAt()
    {
        return $this->deleted_at;
    }

    /**
     * Add FeedbackDisplay entity to collection (one to many).
     *
     * @param FeedbackDisplayInterface $feedbackDisplay
     * @return Feedback
     */
    public function addFeedbackDisplay(FeedbackDisplayInterface $feedbackDisplay)
    {
        $this->feedbackDisplays[] = $feedbackDisplay;

        return $this;
    }

    /**
     * Get FeedbackDisplay entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeedbackDisplays()
    {
        return $this->feedbackDisplays;
    }

    /**
     * Add Vote entity to collection (one to many).
     *
     * @param VoteInterface $vote
     * @return Feedback
     */
    public function addVote(VoteInterface $vote)
    {
        $this->votes[] = $vote;

        return $this;
    }

    /**
     * Get Vote entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * Set FeedbackType entity (many to one).
     *
     * @param FeedbackType $feedbackType
     * @return Feedback
     */
    public function setFeedbackType(FeedbackTypeInterface $feedbackType)
    {
        $this->feedbackType = $feedbackType;

        return $this;
    }

    /**
     * Get FeedbackType entity (many to one).
     *
     * @return FeedbackType
     */
    public function getFeedbackType()
    {
        return $this->feedbackType;
    }

    /**
     * Set User entity (many to one).
     *
     * @param UserInterface $user
     * @return Feedback
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get User entity (many to one).
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

}