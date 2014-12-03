<?php

namespace Ema\RgementBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ema\RgementBundle\Entity\Report;
/**
 * JustifyService
 */
class JustifyService extends Controller
{
    private $absenceRepository;

    public function setContainer(ContainerInterface $container = null) {
        parent::setContainer($container);
        $this->initialize();
    }

    private function initialize() {
        $this->absenceRepository = $this->getDoctrine()->getRepository('EmaRgementBundle:Absence');
    }

    public function getAbsencesToJustify() {
        $reports = array();
        $studentsAbsences = array();
        $students = array();

        $absences = $this->absenceRepository->findByMotif(null);

        foreach ($absences as $absence)
        {
            $students[$absence->getEleve()->getId()] = $absence->getEleve();
            $studentsAbsences[$absence->getEleve()->getId()][] = $absence;
        }

        foreach ($studentsAbsences as $studentId => $absences)
        {
            $report = new Report();
            $report->setAbsences($absences);
            $report->setStudent($students[$studentId]);
            $reports[] = $report;
        }

        return $reports;
    }
}
