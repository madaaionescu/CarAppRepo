<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mada\Bundle\CarAppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('statut','choice',array(
              'choices' => array('sm' => 'Sofer cu masina', 'sfm' =>'Sofer fara masina','p' => 'Pasager'),
              'required' => true,
              'preferred_choices' => array('sm'),
              //'empty_value' => "Alege o optiune"
          ));
        $builder->add('age');
        $builder->add('gender', 'choice', array (
                'choices' => array('M' => 'Masculin', 'F' => 'Feminin'),
                'required' => true,
            ));
        $builder->add('phone');
        
    }

    public function getName()
    {
        return 'carapp_user_registration';
    }
}