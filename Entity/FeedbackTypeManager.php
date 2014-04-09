<?php

namespace Oxind\FeedbackBundle\Entity;

use Oxind\FeedbackBundle\Model\Manager\FeedbackTypeManager as BaseFeedbackTypeManager;
use Oxind\FeedbackBundle\Model\FeedbackTypeInterface;
use Doctrine\ORM\EntityManager;

/**
 * Description of FeedbackTypeManager
 *
 * @author Malek Sufiyan <smalek@oxind.com> Hardik Patel <hpatel@oxind.com>
 */
class FeedbackTypeManager extends BaseFeedbackTypeManager
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
     * @param \Oxind\FeedbackBundle\Model\FeedbackTypeInterface $feedbackType
     */
    protected function doSaveFeedbackType(FeedbackTypeInterface $feedbackType)
    {
        $this->em->persist($feedbackType);
        $this->em->flush();
    }

    /**
     * 
     * @param array $criteria
     * @return type
     */
    public function findFeedbackTypeBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * Returns the fully qualified feedbackType class name
     *
     * @return string
     * */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Function to find all data in array
     * @return array
     */
    public function findAllInArray()
    {
        $repo = $this->em->getRepository($this->class);
        $qb = $repo->createQueryBuilder('f')
                ->getQuery()
                ->getArrayResult();

        $feedbackTypesArray = array();
        /* @var $value type */
        foreach ($qb as $value)
        {
            $feedbackTypesArray[$value['id']] = $value['name'];
        }
        return $feedbackTypesArray;
    }

    /**
     * Function to find all data
     * @return array
     */
    public function findAll()
    {
        $obRepository = $this->em->getRepository($this->class);
        $asResult = $obRepository->createQueryBuilder('f')
                ->getQuery()
                ->getArrayResult();
        
        return $asResult;
    }

}
