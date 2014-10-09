<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EmaRgementBundle:Default:index.html.twig');
    }

    public function exampleAction()
    {
        return $this->render('EmaRgementBundle:Default:example.html.twig');
    }

    public function adminUserListAction()
    {
        return $this->render('EmaRgementBundle:Admin:User/list.html.twig');
    }

    public function adminConfigurationAction()
    {
        return $this->render('EmaRgementBundle:Admin:configuration.html.twig');
    }

}
