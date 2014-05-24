<?php

namespace Mada\Bundle\CarAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MadaCarAppBundle:Default:index.html.twig', array('name' => $name));
    }
}
