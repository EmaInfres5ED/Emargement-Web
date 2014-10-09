<?php

namespace Ema\Bundle\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EmaRgementBundle:Default:index.html.twig', array('name' => $name));
    }
}
