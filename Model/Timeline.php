<?php

namespace Oxind\FeedbackBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

class Timeline
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
    protected $description;

    /**
     *
     * @var FeedbackDisplayInterface 
     */
    protected $feedbackDisplays;

    public function __construct()
    {
        $this->feedbackDisplays = new ArrayCollection();
    }
    
    /**
     * 
     * @param integer $id
     * @return \Oxind\FeedbackBundle\Model\Timeline
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * 
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 
     * @param string $title
     * @return \Oxind\FeedbackBundle\Model\Timeline
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * 
     * @param string $description
     * @return Timeline
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * 
     * @param FeedbackDisplayInterface $feedbackDisplay
     * @return Timeline
     */
    public function addFeedbackDisplay(FeedbackDisplayInterface $feedbackDisplay)
    {
        $this->feedbackDisplays[] = $feedbackDisplay;

        return $this;
    }

    /**
     * 
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getFeedbackDisplays()
    {
        return $this->feedbackDisplays;
    }
}