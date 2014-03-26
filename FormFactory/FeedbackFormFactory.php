<?php

namespace Oxind\FeedbackBundle\FormFactory;

/**
 * Description of FeedbackFormFactory
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
class FeedbackFormFactory implements FeedbackFormFactoryInterface
{
    use \Oxind\FeedbackBundle\FormFactory\Traits\BaseFormFactoryTrait;
    
    public function createForm()
    {
        $builder = $this->formFactory->createNamedBuilder($this->name, $this->type, null, array('validation_groups' => array('CreateFeedback')));
        return $builder->getForm();
    }
}
