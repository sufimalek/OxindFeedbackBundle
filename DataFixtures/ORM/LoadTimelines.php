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

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Oxind\FeedbackBundle\DataFixtures\ORM\LoadFeedbackData;

/**
 * Description of LoadFeedbackTypes
 *
 * @author Hardik Patel <hpatel@oxind.com>
 */
class LoadTimelines extends LoadFeedbackData implements OrderedFixtureInterface
{

    /**
     * 
     * @return int
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * Function to load fixtures in table
     * @param \Doctrine\Common\Persistence\ObjectManager $obManager
     */
    public function load(ObjectManager $obManager)
    {
        $asFixtures = $this->getModelFixtures();
        $timelines = $asFixtures['timelines'];
        $class  = $this->container->getParameter('oxind_feedback.model.timeline.class');
//        var_dump($class);die;
        foreach ($timelines as $title => $values)
        {
            $timeline = new $class();
            $timeline->setTitle($title);
            $timeline->setDescription($values['description']);
            $obManager->persist($timeline);
        }
        
        $obManager->flush();
    }

    public function getModelFile()
    {
        return 'timeline';
    }
}

