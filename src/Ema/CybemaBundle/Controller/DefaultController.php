<?php

namespace Ema\CybemaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EmaCybemaBundle:Default:index.html.twig', array('name' => $name));
    }
}
