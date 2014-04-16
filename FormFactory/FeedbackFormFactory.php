<?php

namespace Oxind\FeedbackBundle\FormFactory;

/*
 * This file is part of the OxindFeedbackBundle package.
 *
 * (c) OxindFeedbackBundle <https://github.com/Oxind/OxindFeedbackBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Description of FeedbackFormFactory
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
class FeedbackFormFactory implements FeedbackFormFactoryInterface
{

    use \Oxind\FeedbackBundle\FormFactory\Traits\BaseFormFactoryTrait;

    /**
     * Function to create form
     * @return type
     */
    public function createForm()
    {
        $builder = $this->formFactory->createNamedBuilder($this->name, $this->type, null, array('validation_groups' => array('CreateFeedback')));
        return $builder->getForm();
    }

}
