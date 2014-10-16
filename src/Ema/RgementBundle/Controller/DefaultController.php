<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->dashboardAction();
    }

    public function dashboardAction()
    {
        return $this->render('EmaRgementBundle:Default:dashboard.html.twig');
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

    public function warnAbsenceAction()
    {
        return $this->render('EmaRgementBundle:Warn:absence.html.twig');
    }

    public function warnDelayAction()
    {
        return $this->render('EmaRgementBundle:Warn:delay.html.twig');
    }

    public function justifyListAction()
    {
        return $this->render('EmaRgementBundle:Justify:list.html.twig');
    }

    public function justifyAbsenceAction()
    {
        return $this->render('EmaRgementBundle:Justify:absence.html.twig');
    }

    public function justifyDelayAction()
    {
        return $this->render('EmaRgementBundle:Justify:delay.html.twig');
    }

    public function adminUserListAction()
    {
        return $this->render('EmaRgementBundle:Admin:User/list.html.twig');
    }

    public function adminConfigurationAction()
    {
        return $this->render('EmaRgementBundle:Admin:configuration.html.twig');
    }

    public function exportAction()
    {
        return $this->render('EmaRgementBundle:Default:export.html.twig');
    }

    public function reportAction()
    {
        return $this->render('EmaRgementBundle:Report:report.html.twig');
    }

    public function notificationAction()
    {
        return $this->render('EmaRgementBundle:Default:notification.html.twig');
    }

}
