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
class LoadFeedbackTypes extends LoadFeedbackData implements OrderedFixtureInterface
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
        $asFixtures = $this->getModelFixtures();
        $asFeedbackTypes = $asFixtures['feedbacktypes'];
        $class  = $this->container->getParameter('oxind_feedback.model.feedbacktype.class');
        
        foreach($asFeedbackTypes as $name=>$values)
        {
            $feedbackType = new $class();
            $feedbackType->setName($name);
            
            foreach($values['statuses'] as $status)
            {
                $feedbackType->addStatuses($status);
            }
            
            $feedbackType->setVotable($values['votable']);
            $feedbackType->setVoteMinPoint($values['vote_min_point']);
            $feedbackType->setVoteMaxPoint($values['vote_max_point']);
            
            foreach($values['displayable_statuses'] as $status)
            {
                if(in_array($status,$values['statuses']))
                {
                    $feedbackType->addDisplayableStatuses($status);
                }
                else
                {
                    throw new Exception( $status. ' not found in \'statuses\'. check oxind_feedback.statuses configuration. ');
                }
                
            }
            
            if(!in_array( $values['timeline_start_status'], $values['statuses']))
            {
                 throw new Exception( $values['timeline_start_status']. ' not found in \'statuses\'. check oxind_feedback.statuses configuration. ');
            }
            
            if(!in_array($values['timeline_end_status'], $values['statuses']))
            {
                 throw new Exception( $values['timeline_end_status']. ' not found in \'statuses\'. check oxind_feedback.statuses configuration. ');
            }
            
            if(!in_array($values['credit_vote_status'], $values['statuses']))
            {
                 throw new Exception( $values['credit_vote_status']. ' not found in \'statuses\'. check oxind_feedback.statuses configuration. ');
            }
            
            $feedbackType->setTimelineStartStatus($values['timeline_start_status']);
            $feedbackType->setTimelineEndStatus($values['timeline_end_status']);
            $feedbackType->setCreditVoteStatus($values['credit_vote_status']);
            
            $obManager->persist($feedbackType);
        }
        
        $obManager->flush();
    }

    /**
     * Function to get model File name
     * @return string
     */
    public function getModelFile()
    {
        return 'feedbacktype';
    }
}

