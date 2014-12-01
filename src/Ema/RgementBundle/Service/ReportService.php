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
    public function getAbsencesForStudentIdBetweenDates($studentId, \DateTime $fromDate, \DateTime $toDate)
    {
        $result = null;
        $absences = array();
        $retards = array();
        $report = new Report();

        $student = new Etudiant();
        $student->setPrenom('Janne');
        $student->setNom('CépasfaireuneBDD');
        $student->setEmail('noadminBDD@gmail.com');
        $student->setId($studentId);

        $report->setStudent($student);

        $promotion = new Promotion();
        $promotion->setLibelle("TOTO5");

        $report->setPromotion($promotion);

        $absence = new Absence();
        $absence->setEleve($student);
        $absence->setDateDebut(new \DateTime('now'));
        $absence->setDateFin(new \DateTime('+1 weeks'));
        $absence->setMotif("Trop pu du cul");

        $absences[] = $absence;

        $absence = new Absence();
        $absence->setEleve($student);
        $absence->setDateDebut(new \DateTime('+2 weeks'));
        $absence->setDateFin(new \DateTime('+20 days'));
        $absence->setMotif("Infection gastrique");

        $absences[] = $absence;

        $absence = new Absence();
        $absence->setEleve($student);
        $absence->setDateDebut(new \DateTime('+3 weeks'));
        $absence->setDateFin(new \DateTime('+25 days'));
        $absence->setMotif("Injustifié");

        $absences[] = $absence;

        $report->setAbsences($absences);

        $retard = new Retard();
        $retard->setEtudiant($student);
        $retard->setDureeRetard(20);
        $retard->setMotif('Circulation');
        $retard->setDateprevu(new \DateTime('+20 days'));

        $retards[] = $retard;

        $retard = new Retard();
        $retard->setEtudiant($student);
        $retard->setDureeRetard(120);
        $retard->setMotif('Injustifié');
        $retard->setDateprevu(new \DateTime('+21 days'));

        $retards[] = $retard;

        $report->setRetards($retards);

        $result = $report;

        return $result;
    }

}
