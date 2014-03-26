<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Oxind\FeedbackBundle\Form\Type;

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
        $builder->add('name','text');
        $builder->add('votable','checkbox');
        
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'data_class' => $this->threadClass,
        ));
    }

    public function getName()
    {
        return 'oxind_feedback_feedbacktype';
    }
}
