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
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Oxind\DashboardBundle\Entity\FeedbackType;

/**
 * Description of LoadFeedbackTypes
 *
 * @author Hardik Patel <hpatel@oxind.com>
 */
class LoadFeedbackTypes extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * 
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }

    /**
     * Function to load fixtures in table
     * @param \Doctrine\Common\Persistence\ObjectManager $obManager
     */
    public function load(ObjectManager $obManager)
    {
        $obFeedbackType1 = new FeedbackType();
        $obFeedbackType1->setName("Issues");
        $obFeedbackType1->addStatuses('Open');
        $obFeedbackType1->addStatuses('Close');
        $obFeedbackType1->addStatuses('Accepted');
        $obFeedbackType1->addStatuses('Rejected');
        $obFeedbackType1->addStatuses('Completed');
        $obFeedbackType1->setVotable(1);
        $obFeedbackType1->setVoteMinPoint(1);
        $obFeedbackType1->setVoteMaxPoint(5);


        $obFeedbackType2 = new FeedbackType();
        $obFeedbackType2->setName("Suggestions");
        $obFeedbackType2->addStatuses('Open');
        $obFeedbackType2->addStatuses('Close');
        $obFeedbackType2->addStatuses('Accepted');
        $obFeedbackType2->addStatuses('Rejected');
        $obFeedbackType2->setVotable(1);
        $obFeedbackType2->setVoteMinPoint(1);
        $obFeedbackType2->setVoteMaxPoint(3);


        $obFeedbackType3 = new FeedbackType();
        $obFeedbackType3->setName("Special Comments");
        $obFeedbackType3->addStatuses('Open');
        $obFeedbackType3->addStatuses('Close');
        $obFeedbackType3->setVotable(1);
        $obFeedbackType3->setVoteMinPoint(1);
        $obFeedbackType3->setVoteMaxPoint(2);

        $obManager->persist($obFeedbackType1);
        $obManager->persist($obFeedbackType2);
        $obManager->persist($obFeedbackType3);
        $obManager->flush();
    }

}

