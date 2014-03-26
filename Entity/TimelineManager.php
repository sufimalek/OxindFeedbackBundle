<?php

namespace Oxind\FeedbackBundle\Entity;

use Oxind\FeedbackBundle\Model\Manager\TimelineManager as BaseTimelineManager;
use Oxind\FeedbackBundle\Model\TimelineInterface;
use Doctrine\ORM\EntityManager;
/**
 * Description of TimelineManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
class TimelineManager extends BaseTimelineManager
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
        $this->em = $em;
        $this->repository = $em->getRepository($class);

        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
    }
    /**
     * 
     * @param \Oxind\FeedbackBundle\Model\TimelineInterface $timeline
     */
    protected function doSaveTimeline(TimelineInterface $timeline)
    {
        $this->em->persist($timeline);
        $this->em->flush();
    }

    /**
     * 
     * @param array $criteria
     * @return type
     */
    public function findTimelineBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * Returns the fully qualified timeline class name
     *
     * @return string
     **/
    public function getClass()
    {
        return $this->class;
    }

}
