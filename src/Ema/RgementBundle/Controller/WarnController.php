<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WarnController extends Controller
{
    public function warnAbsenceAction()
    {
        return $this->render('EmaRgementBundle:Warn:absence.html.twig');
    }

    public function warnDelayAction()
    {
        return $this->render('EmaRgementBundle:Warn:delay.html.twig');
    }
}
