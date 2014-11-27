<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JustifyController extends Controller
{
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
}
