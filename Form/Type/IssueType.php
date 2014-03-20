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
 * Description of IssueType
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
class IssueType extends AbstractType
{ 
    protected $issueClass;
    
    public function __construct($issueClass)
    {
        $this->issueClass = $issueClass;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title','text');
        $builder->add('description','textarea');
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'data_class'=>$this->issueClass,
        ));
    }
    
    public function getName()
    {
        return 'oxind_feedback_issue';
    }

}
