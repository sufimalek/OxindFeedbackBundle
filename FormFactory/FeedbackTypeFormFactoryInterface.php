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
