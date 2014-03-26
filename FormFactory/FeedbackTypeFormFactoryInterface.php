<?php

namespace Oxind\FeedbackBundle\FormFactory;

/**
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
interface FeedbackTypeFormFactoryInterface
{
    /**
     * Creates a thread form
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createForm();
}
