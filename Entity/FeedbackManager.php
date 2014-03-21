<?php

namespace Oxind\FeedbackBundle\Entity;

use Doctrine\ORM\EntityManager;
use Oxind\FeedbackBundle\Model\Manager\FeedbackManager as BaseFeedbackManager;
use Oxind\FeedbackBundle\Model\FeedbackInterface;

/**
 * Description of FeedbackManager
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
class FeedbackManager extends BaseFeedbackManager
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

    protected function doSaveFeedback(FeedbackInterface $feedback)
    {
        $this->em->persist($feedback);
        $this->em->flush();
    }

    public function findFeedbackBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * Returns the fully qualified feedback class name
     *
     * @return string
     **/
    public function getClass()
    {
        return $this->class;
    }

}
