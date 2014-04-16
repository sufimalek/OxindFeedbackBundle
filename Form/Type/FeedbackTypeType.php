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
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of FeedbackTypeType
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
class FeedbackTypeType extends AbstractType
{

    protected $feedbackTypeClass;

    /**
     * Constructor
     * @param type $feedbackTypeClass
     */
    public function __construct($feedbackTypeClass)
    {
        $this->feedbackTypeClass = $feedbackTypeClass;
    }

    /**
     * 
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden');
        $builder->add('name', 'hidden');
        $builder->add('votable', 'hidden');
        $builder->add('statuses', 'hidden');
        $builder->add('vote_min_point', 'hidden');
        $builder->add('vote_max_point', 'hidden');
    }

    /**
     * Function to set default options
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'data_class' => $this->feedbackTypeClass,
        ));
    }

    /**
     * Function to get name
     * @return string
     */
    public function getName()
    {
        return 'oxind_feedback_feedbacktype';
    }

}
