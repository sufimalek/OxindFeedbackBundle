<?php

namespace Oxind\FeedbackBundle\Entity;

use Oxind\FeedbackBundle\Model\Manager\FeedbackDisplayManager as BaseFeedbackDisplayManager;
use Oxind\FeedbackBundle\Model\TimelineInterface;
use Oxind\FeedbackBundle\Model\FeedbackDisplayInterface;
use Doctrine\ORM\EntityManager;

/**
 * Description of FeedbackDisplayManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */

class FeedbackDisplayManager extends BaseFeedbackDisplayManager
{
    
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $class;

    /**
     * Constructor.
     *
     * @param \Doctrine\ORM\EntityManager $em
     * @param string $class
     */
    public function __construct(EntityManager $em, $class)
    {
        var_dump($class);die;
        $this->em = $em;
        $this->repository = $em->getRepository($class);

        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
    }
    
    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\FeedbackDisplayInterface $feedbackDisplay
     */
    protected function doSaveFeedbackDisplay(FeedbackDisplayInterface $feedbackDisplay)
    {
        $this->em->persist($feedbackDisplay);
        $this->em->flush();
    }

    /**
     * 
     * @param array $criteria
     * @return type
     */
    public function findFeedbackDisplayBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * Returns the fully qualified feedbackDisplay class name
     *
     * @return string
     **/
    public function getClass()
    {
        return $this->class;
    }

    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\TimelineInterface $timeline
     * @param \Oxind\FeedbackBundle\Model\FeedbackDisplayInterface $feedbackDisplay
     */
    public function findFeedbackDisplayByTimeline(TimelineInterface $timeline, FeedbackDisplayInterface $feedbackDisplay)
    {
        
    }

}
