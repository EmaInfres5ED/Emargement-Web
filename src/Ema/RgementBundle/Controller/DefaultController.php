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
        return $this->render('EmaRgementBundle:Stats:stats.html.twig');
    }
    public function statsFrequencyDelayAction()
    {
        return $this->render('EmaRgementBundle:Stats:Frequency/delay.html.twig');
    }
    public function statsFrequencyAbsenceAction()
    {
        return $this->render('EmaRgementBundle:Stats:Frequency/absence.html.twig');
    }
    public function statsAccumulationDelayAction()
    {
        return $this->render('EmaRgementBundle:Stats:Accumulation/delay.html.twig');
    }
    public function statsAccumulationAbsenceAction()
    {
        return $this->render('EmaRgementBundle:Stats:Accumulation/absence.html.twig');
    }
    public function exampleAction()
    {
        return $this->render('EmaRgementBundle:Default:example.html.twig');
    }
    public function warnMissingAction()
    {
        return $this->render('EmaRgementBundle:Default:warnMissing.html.twig');
    }
    public function justifyListAction()
    {
        return $this->render('EmaRgementBundle:Default:justifyList.html.twig');
    }
    public function justifyMissingAction()
    {
        return $this->render('EmaRgementBundle:Default:justifyMissing.html.twig');
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
