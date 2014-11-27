<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportController extends Controller
{
    public function listAction()
    {
        return $this->render('EmaRgementBundle:Report:list.html.twig', array(
                // ...
            ));    }

    public function showAction($id)
    {
        if ($id <= 0)
        {
            return $this->listAction();
        }
        return $this->render('EmaRgementBundle:Report:show.html.twig', array(
                // ...
            ));    }

}