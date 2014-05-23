<?php

namespace Mada\Bundle\CarAppBundle\Form;

use Mada\Bundle\CarAppBundle\Form\DataTransformer\UserToString;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class RoutesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $entityManager = $options['em'];
        $modelTransformer = new UserToString($entityManager);
        
        $builder
            ->add('latStart')
            ->add('longStart')
            ->add('latStop')
            ->add('longStop')
            ->add('dateCreated')
            ->add(
                    $builder->create('owner','hidden')
                    ->addModelTransformer($modelTransformer))
            ->add('seatsAvailable')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mada\Bundle\CarAppBundle\Entity\Routes'
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
        return 'mada_bundle_carappbundle_routes';
    }
}
