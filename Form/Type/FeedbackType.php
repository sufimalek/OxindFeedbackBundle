<?php
namespace Oxind\FeedbackBundle\Form\Type;

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
        $builder->add('content', 'textarea',array('attr'=>array('width'=>"100%")));
        $builder->add('submit', 'submit');
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'data_class' => $this->feedbackClass,
        ));
    }

    public function getName()
    {
        return 'oxind_feedback_feedback';
    }

}
