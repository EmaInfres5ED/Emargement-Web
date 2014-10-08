<?php

namespace EMA\Bundle\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EMARgementBundle:Default:index.html.twig', array('name' => $name));
    }
}
