<?php


namespace Ema\RgementBundle\Service;

use Ema\RgementBundle\Entity\Report;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportService extends Controller
{

    public function getAllReports(\DateTime $from, \DateTime $to, $promoId)
    {
        $result = array();
        $etudiantsPromotion = $this->getDoctrine()->getRepository('EmaRgementBundle:EtudiantPromotion')
            ->findBy(array('promotion' => $promoId));


        $studentsIds = array();
        $students = array();
        foreach ($etudiantsPromotion as $etudiantPromotion)
        {
            /* @var $etudiantPromotion Ema\RgementBundle\Entity\EtudiantPromotion */
            $studentsIds[] = $etudiantPromotion->getEtudiant()->getId();
            $students[$etudiantPromotion->getEtudiant()->getId()] = $etudiantPromotion->getEtudiant();
        }

        $absences = $this->getDoctrine()->getRepository('EmaRgementBundle:Absence')
            ->findAllBetweenDatesForStudents($studentsIds, $from, $to);

        $retards = $this->getDoctrine()->getRepository('EmaRgementBundle:Retard')
            ->findAllBetweenDatesForStudents($studentsIds, $from, $to);

        foreach ($studentsIds as $studentId)
        {
            if (isset($absences[$studentId]) || isset($retards[$studentId]))
            {
                $result[$studentId]['student'] = null;
                $result[$studentId]['absencesCount'] = 0;
                $result[$studentId]['retardsCount'] = 0;
                if (isset($absences[$studentId]))
                {
                    $result[$studentId]['absencesCount'] = $absences[$studentId];
                    $result[$studentId]['student'] = $students[$studentId];
                }
                if (isset($retards[$studentId]))
                {
                    $result[$studentId]['retardsCount'] = $retards[$studentId];
                    $result[$studentId]['student'] = $students[$studentId];
                }
            }
        }

        return $result;
    }

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
