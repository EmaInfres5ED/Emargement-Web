<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EmaRgementBundle:Default:index.html.twig');
    }
    public function statsAction()
    {
        return $this->render('EmaRgementBundle:Default:stats/stats.html.twig');
    }
    public function statsfrequencyDelayAction()
    {
        return $this->render('EmaRgementBundle:Default:stats/frequency/delay.html.twig');
    }
    public function statsfrequencyAbsenceAction()
    {
        return $this->render('EmaRgementBundle:Default:stats/frequency/absence.html.twig');
    }
    public function statsaccumulationDelayAction()
    {
        return $this->render('EmaRgementBundle:Default:stats/accumulation/delay.html.twig');
    }
    public function statsaccumulationAbsenceAction()
    {
        return $this->render('EmaRgementBundle:Default:stats/accumulation/absence.html.twig');
    }
}
