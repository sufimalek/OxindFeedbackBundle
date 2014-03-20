<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Oxind\FeedbackBundle\FormFactory;

/**
 *
 * @author Bhavin Jagad <bjagd@oxind.com>
 */
interface IssueFormFactoryInterface
{
    /**
     * Creates a issue form
     *
     * @return FormInterface
     */
    public function createForm();
}
