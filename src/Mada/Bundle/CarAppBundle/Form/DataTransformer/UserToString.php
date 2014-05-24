<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Mada\Bundle\CarAppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use MadaCarAppBundle\Entity\Users;

class UserToString implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (owner) to a string (number).
     *
     * @param  owner|null $owner
     * @return string
     */
    public function transform($owner)
    {
        //var_dump($owner); die;
        if (null === $owner) {
            return "";
        }

        return $owner->getId();
    }

    /**
     * Transforms a string (number)// id // to an object (owner).
     *
     * @param  string $number 
     *
     * @return owner|null
     *
     * @throws TransformationFailedException if object (owner) is not found.
     */
    public function reverseTransform($number)
    {
        if (!$number) {
            return null;
        }

        $owner = $this->om
            ->getRepository('MadaCarAppBundle:Users')
            ->findOneBy(array('id' => $number))
        ;

        if (null === $owner) {
            throw new TransformationFailedException(sprintf(
                'An owner with id "%s" does not exist!',
                $number
            ));
        }

        return $owner;
    }
}