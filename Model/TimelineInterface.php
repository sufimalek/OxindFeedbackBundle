<?php

namespace Oxind\FeedbackBundle\Model;

interface TimelineInterface
{
    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return TimelineInterface
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
     * @return TimelineInterface
     */
    public function setTitle($title);

    /**
     * Get the value of title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set the value of description.
     *
     * @param string $description
     * @return TimelineInterface
     */
    public function setDescription($description);

    /**
     * Get the value of description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Add FeedbackDisplay entity to collection (one to many).
     *
     * @param FeedbackDisplayInterface $feedbackDisplay
     * @return TimelineInterface
     */
    public function addFeedbackDisplay(FeedbackDisplayInterface $feedbackDisplay);

    /**
     * Get FeedbackDisplay entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeedbackDisplays();
    
}