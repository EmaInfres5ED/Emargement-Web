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

    public function adminPanelUserListAction()
    {
        return $this->render('EmaRgementBundle:AdminPanel:userList.html.twig');
    }

    public function adminPanelConfigurationAction()
    {
        return $this->render('EmaRgementBundle:AdminPanel:configuration.html.twig');
    }

}
