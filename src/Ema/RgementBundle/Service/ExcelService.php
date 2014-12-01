<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExportController extends Controller
{
    public function listAction()
    {
        return $this->render('EmaRgementBundle:Default:export.html.twig');
    }

}
