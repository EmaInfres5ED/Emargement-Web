<?php


namespace Ema\RgementBundle\Service;

use Ema\RgementBundle\Entity\Etudiant;
use Ema\RgementBundle\Entity\Absence;
use Ema\RgementBundle\Entity\Report;
use Ema\RgementBundle\Entity\Retard;
use Ema\RgementBundle\Entity\Promotion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportService extends Controller
{
    public function getAbsencesForStudentIdBetweenDates($studentId, $promoId, \DateTime $fromDate, \DateTime $toDate)
    {
        $etudiantPromotion = $this->getDoctrine()->getRepository('EmaRgementBundle:EtudiantPromotion')
            ->findOneBy(array('etudiant' => $studentId, 'promotion' => $promoId));

        $student = $etudiantPromotion->getEtudiant();
        $promotion = $etudiantPromotion->getPromotion();
        $absences = $this->getDoctrine()->getRepository('EmaRgementBundle:Absence')
            ->findAllBetweenDatesForAStudent($studentId, $fromDate, $toDate);
        $retards = $this->getDoctrine()->getRepository('EmaRgementBundle:Retard')
            ->findAllBetweenDatesForAStudent($studentId, $fromDate, $toDate);

        $report = new Report();

        $report->setStudent($student);
        $report->setPromotion($promotion);
        $report->setAbsences($absences);
        $report->setRetards($retards);

        return $report;
    }

}
