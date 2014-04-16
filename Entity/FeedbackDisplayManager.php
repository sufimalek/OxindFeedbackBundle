<?php

namespace Oxind\FeedbackBundle\Entity;

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        $this->em = $em;
        $this->repository = $em->getRepository($class);

        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
    }

    /**
     * Returns the fully qualified feedbackDisplay class name
     *
     * @return string
     * */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Function to save Feedback Display
     * @param \Oxind\FeedbackBundle\Model\FeedbackDisplayInterface $feedbackDisplay
     */
    protected function doSaveFeedbackDisplay(FeedbackDisplayInterface $feedbackDisplay)
    {
        $this->em->persist($feedbackDisplay);
        $this->em->flush();
    }

    /**
     * Function to find feedbackdiplay 
     * @param array $criteria
     * @return type
     */
    public function findFeedbacksDisplayBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
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
     * Function to find feedbacks by timeline
     * @param \Oxind\FeedbackBundle\Model\TimelineInterface $timeline
     * @param \Oxind\FeedbackBundle\Model\FeedbackDisplayInterface $feedbackDisplay
     */
    public function findFeedbackDisplayByTimeline(TimelineInterface $timeline)
    {
        return $this->findFeedbacksDisplayBy(array('timeline' => $timeline));
    }

    /**
     * Function to get feedbacks to display on timeline
     * @param \Oxind\FeedbackBundle\Model\TimelineInterface $timeline
     * @return type
     */
    public function findFeedbackDisplayByTimelineSorted(TimelineInterface $timeline)
    {
        $qb = $this->repository->createQueryBuilder('fd')
                ->select('fd')
                ->where('fd.timeline = :timeline')
                ->orderBy('fd.start_date')
                ->setParameter('timeline', $timeline);


        return $qb->getQuery()->getResult();
    }

}
