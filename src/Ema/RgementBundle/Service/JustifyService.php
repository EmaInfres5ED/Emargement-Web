<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JustifyService extends Controller
{
    private absenceRepository;
    private retardRepository;
    private coursRepository;
    private participationRepository;
    private etudiantRepository;
    private presenceRepository;

    public function __construct() {
        $this->absenceRepository = $this->getDoctrine()->getRepository('EmaRgementBundle:Absence');
        $this->retardRepository = $this->getDoctrine()->getRepository('EmaRgementBundle:Retard');
        $this->coursRepository = $this->getDoctrine()->getRepository('EmaRgementBundle:Cours');
        $this->participationRepository = $this->getDoctrine()->getRepository('EmaRgementBundle:Participation');
        $this->etudiantRepository = $this->getDoctrine()->getRepository('EmaRgementBundle:Etudiant');
        $this->presenceRepository = $this->getDoctrine()->getRepository('EmaRgementBundle:Presence');
    }

    public function getAbsences() {
        $absences = new JustifyAbsence();

        $absences->
    }
}
