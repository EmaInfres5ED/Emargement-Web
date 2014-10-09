<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EmaRgementBundle:Default:index.html.twig');
    }
    public function statsfrequencyDelayAction()
    {
        return $this->render('EmaRgementBundle:Default:stats/frequency/Delay.html.twig');
    }
    public function statsfrequencyAbsenceAction()
    {
        return $this->render('EmaRgementBundle:Default:stats/frequency/Absence.html.twig');
    }
    public function statsaccumulationDelayAction()
    {
        return $this->render('EmaRgementBundle:Default:stats/accumulation/Delay.html.twig');
    }
    public function statsaccumulationAbsenceAction()
    {
        return $this->render('EmaRgementBundle:Default:stats/accumulation/Absence.html.twig');
    }
}
