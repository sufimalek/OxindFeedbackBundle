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
 * Description of FeedbackType
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
class FeedbackType extends AbstractType
{

    private $feedbackClass;
    protected $feedbackType;

    public function __construct($feedbackClass)
    {
        $this->feedbackClass = $feedbackClass;
    }

    /**
     * Configures a Thread form.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text');
        $builder->add('content', 'textarea', array('attr' => array('width' => "100%")));
        $builder->add('submit', 'submit');
    }

    /**
     * Function to set default options
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'data_class' => $this->feedbackClass,
        ));
    }

    /**
     * Function to get Name
     * @return string
     */
    public function getName()
    {
        return 'oxind_feedback_feedback';
    }

}
