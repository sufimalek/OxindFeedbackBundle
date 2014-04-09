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

    /**
     * Function to create form for filter options
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->setAttributes(array('id' => 'feecback_filter'));
        $builder->add('feedbacktypes', 'entity', array(
            'class' => 'OxindFeedbackBundle:FeedbackType',
            'property' => 'name',
            'empty_value' => '---- Select Feedback Type ----',
        ));

        $builder->add('statuses', 'choice', array(
            'empty_value' => '-- Select a status --',
            'choices' => array(),
            'required' => false
        ));
        $builder->add('submit', 'submit');
    }

    /**
     * Function to get form name
     * @return string
     */
    public function getName()
    {
        return 'feecback_filter';
    }

}
