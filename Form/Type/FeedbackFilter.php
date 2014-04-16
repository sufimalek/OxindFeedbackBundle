<?php

namespace Oxind\FeedbackBundle\Form\Type;

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of FeedbackFilter
 *
 * @author Hardik Patel <hpatel@oxind.com>
 */
class FeedbackFilter extends AbstractType
{

    protected $feedbackType;

    public function __construct($feedbacType)
    {
        $this->feedbackType = $feedbacType;
    }

    /**
     * Function to create form for filter options
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAttributes(array('id' => 'feecback_filter'));
        $builder->add('search','text',array('required' =>false));
        $builder->add('page','hidden',array('attr'=>array('value'=>0)));
        $builder->add('statuses', 'choice', array(
            'empty_value' => '-- Select a status --',
            'choices' => $this->getFeedbackStatusList(),
            'required' => false
        ));
        $builder->add('feedbacktype_id', 'hidden', array('attr' => array('value' => $this->feedbackType->getId())));
    }

    /**
     * Function to get form name
     * @return string
     */
    public function getName()
    {
        return 'feecback_filter';
    }

    /**
     * 
     */
    protected function getFeedbackStatusList()
    {
        $asStatuses = array();

        if ($this->feedbackType != null && !empty($this->feedbackType))
        {
            foreach ($this->feedbackType->getDisplayableStatuses() as $ssValue)
            {
                $asStatuses[strtolower($ssValue)] = ucfirst($ssValue);
            }
        }

        return $asStatuses;
    }

}
