<?php

namespace Mada\Bundle\CarAppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsersType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
             //   ->add('statut')
           // multiple choice
            ->add('statut','choice',array(
              'choices' => array('sm' => 'Sofer cu masina', 'sfm' =>'Sofer fara masina','p' => 'Pasager'),
              'required' => true,
              'preferred_choices' => array('sm'),
              //'empty_value' => "Alege o optiune"
          ))
            ->add('age')
            ->add('gender', 'choice', array (
                'choices' => array('M' => 'Masculin', 'F' => 'Feminin'),
                'required' => true,
            ))
            ->add('phone')
            ->add('email')
            ->add('username')
            ->add('password', 'repeated', array(
                'type' => 'password'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mada\Bundle\CarAppBundle\Entity\Users'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mada_bundle_carappbundle_users';
    }
}
