<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Oxind\FeedbackBundle\FormFactory;

/**
 *
 * @author Malek Sufiyan <smalek@oxind.com>
 */
interface BaseFormFactoryInterface
{
    /** Creates a thread form
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createForm();
}
