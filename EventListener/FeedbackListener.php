<?php

namespace Oxind\FeedbackBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Oxind\FeedbackBundle\Entity\Feedback;
use Oxind\FeedbackBundle\Model\FeedbackInterface;
use Oxind\FeedbackBundle\Model\TimelineInterface;
/**
 * Description of FeedbackListener
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
class FeedbackListener
{
    protected $container;

    /**
     * 
     * @param type $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        
        if($entity instanceof Feedback)
        {
            $this->handleFeedbackPrePersist($entity);
        }
    }
    
    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Feedback)
        {
            $status = $entity->getStatus();
            $creditVoteStatus = $entity->getFeedbackType()->getCreditVoteStatus();
            if ($creditVoteStatus == $status)
            {
                $voteManager = $this->container->get('oxind_feedback.manager.vote.default');
                $voteManager->creditVotePointsBack($entity);
            }
        }
    }
    
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Feedback)
        {
            $entity->setUpdatedAt(new \DateTime());
        }
    }
    
    public function addFeedbackToTimeline(FeedbackInterface $feedback, TimelineInterface $timeline)
    {
        $time = new \DateTime();
        $feedbackDisplayManager = $this->container->get('oxind_feedback.manager.feedbackdisplay.default');
        $feedbackDisplay = $feedbackDisplayManager->createFeedbackDisplay($feedback, $timeline);
        $feedbackDisplay->setStartDate($time);
        $feedback->addFeedbackDisplay($feedbackDisplay);
    }

    public function setFeedbackEndDateInTimline(FeedbackInterface $feedback, TimelineInterface $timeline)
    {
        $feedbackDisplays = $feedback->getFeedbackDisplays();
        $time = new \DateTime();
        foreach ($feedbackDisplays as $feedbackDisplay)
        {
            if ($feedbackDisplay->getTimeline()->getId() == $timeline->getId() && $feedbackDisplay->getFeedback()->getId() == $feedback->getId() && ($feedbackDisplay->getEndDate() == null))
            {
                $feedbackDisplay->setEndDate($time);
                break;
            }
        }
    }

    public function handleFeedbackPrePersist(FeedbackInterface $entity)
    {  
        $time = new \DateTime();
        ($entity->getCreatedAt() == NULL)? $entity->setCreatedAt($time) : null;
        $entity->setUpdatedAt($time);
        $status = $entity->getStatus();
        
        if($status === null)
        {
            $status = $entity->getFeedbackType()->getDefaultStatus();
            $entity->setStatus($status);
        }
        
        $timelineStartStatus = $entity->getFeedbackType()->getTimelineStartStatus();
        $timelineEndStatus = $entity->getFeedbackType()->getTimelineEndStatus();
        
        $timeManager = $this->container->get('oxind_feedback.manager.timeline.default');
        
        $timeLine = $timeManager->findTimelineByTitle('main');
        
        if($timelineStartStatus === $status 
           && count($entity->getFeedbackDisplays()) === 0 )
        {
            $this->addFeedbackToTimeline($entity, $timeLine);
        }
        if($timelineEndStatus === $status 
           && count($entity->getFeedbackDisplays()) !== 0     )
        {
            $this->setFeedbackEndDateInTimline($entity, $timeLine);
        }
    }
}
