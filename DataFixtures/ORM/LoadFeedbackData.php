<?php

namespace Oxind\FeedbackBundle\DataFixtures\ORM;

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Description of LoadFeedbackTypeData
 *
 * @author Hardik Patel <hpatel@oxind.com>
 */
abstract class LoadFeedbackData extends AbstractFixture implements ContainerAwareInterface
{

    /**
     * Return the file for the current model.
     */
    abstract function getModelFile();

    /**
     * @var Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * Make the sc available to our loader.
     *
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Return the fixtures for the current model.
     *
     * @return Array
     */
    public function getModelFixtures()
    {
        $rootDir = $this->container->get('kernel')->getRootDir();

        $resourcePath = $this->container->getParameter('oxind_feedback.fixtures');
        $filePath = $resourcePath . '/' . $this->getModelFile() . '.yml';
        $filePath = $rootDir . '/../src/' . $filePath;

        $fixturesPath = realpath($filePath);
        $fixtures = Yaml::parse($fixturesPath);
        return $fixtures;
    }

}

