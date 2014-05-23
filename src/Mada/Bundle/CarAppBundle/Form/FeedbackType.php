<?php

namespace Mada\Bundle\CarAppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Mada\Bundle\CarAppBundle\Form\DataTransformer\UserToString;

class FeedbackType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // pentru id user-ului autentificat
        $entityManager = $options['em'];
        $modelTransformer = new UserToString($entityManager);
        
        // adaugam ruta automat
        // $route =
        
        $builder
            ->add('rating')
            ->add('comment')
            ->add('routeId','hidden')
//            ->add('ownerId') // hidden
           ->add(
                    $builder->create('owner','hidden')
                    ->addModelTransformer($modelTransformer))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mada\Bundle\CarAppBundle\Entity\Feedback'
        ))
                 ->setRequired(array(
                'em',
            ))
            ->setAllowedTypes(array(
                'em' => 'Doctrine\Common\Persistence\ObjectManager',
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mada_bundle_carappbundle_feedback';
    }
}
