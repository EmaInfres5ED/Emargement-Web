<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JustifyController extends Controller
{
    public function justifyListAction()
    {
        $absences = $this->get('justify_service')->getAbsences();

        return $this->render('EmaRgementBundle:Justify:list.html.twig', array(
            'absences' => $absences
        ));
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
