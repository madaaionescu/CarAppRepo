<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Mada\Bundle\CarAppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PhoneValidator extends ConstraintValidator
{
    public $message = 'bla bla bla wrong phone number';
}
