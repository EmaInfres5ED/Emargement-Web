<?php

namespace Ema\RgementBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ema\RgementBundle\Entity\JustifyAbsence;
/**
 * JustifyService
 */
class JustifyService extends Controller
{
    private $absenceRepository;
    private $retardRepository;
    private $coursRepository;
    private $participationRepository;
    private $etudiantRepository;
    private $presenceRepository;

    public function setContainer(ContainerInterface $container = null) {
        parent::setContainer($container);
        $this->initialize();
    }

    private function initialize() {
        $this->absenceRepository = $this->getDoctrine()->getRepository('EmaRgementBundle:Absence');
        $this->retardRepository = $this->getDoctrine()->getRepository('EmaRgementBundle:Retard');
        $this->coursRepository = $this->getDoctrine()->getRepository('EmaRgementBundle:Cours');
        $this->participationRepository = $this->getDoctrine()->getRepository('EmaRgementBundle:Participation');
        $this->etudiantRepository = $this->getDoctrine()->getRepository('EmaRgementBundle:Etudiant');
        $this->presenceRepository = $this->getDoctrine()->getRepository('EmaRgementBundle:Presence');
    }

    public function getAbsences() {
        $absences = new JustifyAbsence();

        $absences->setNom('GODINEZ');
        $absences->setPrenom('Pablo');
        $absences->setCours('Management des équipes');
        $absences->setDate(new \DateTime('now'));
        $absences->setHeureDebut('9h00');
        $absences->setHeureFin('12h00');

        return $absences;
    }
}
