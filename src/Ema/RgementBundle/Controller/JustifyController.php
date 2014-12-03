<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ema\RgementBundle\Entity\Etudiant;

class JustifyController extends Controller
{
    private $justifyService;

    public function justifyListAction()
    {
        return $this->render('EmaRgementBundle:Justify:list.html.twig');
    }

    public function justifyAbsenceAction($studentId = null, $absenceId = null)
    {
        $students = $this->getDoctrine()
            ->getRepository('EmaRgementBundle:Etudiant')
            ->findAll();

        if($this->get('request')->getMethod() === 'POST') {
            $studentId = $this->get('request')->get('student');
            $absencesId = $this->get('request')->get('absenceId');
            $motif = $this->get('request')->get('motif');

            $em = $this->getDoctrine()->getEntityManager();
            $absences = $em
                ->getRepository('EmaRgementBundle:Absence')
                ->findById($absencesId);

            foreach ($absences as $absence) {
                $absence->setMotif($motif);
            }

            $em->flush();
            $this->get('request')->getSession()->getFlashBag()->add('notice', 'Justification(s) enregistrée(s).');
            return $this->redirect($this->generateUrl('ema_rgement_justify_absence'));
        }

        return $this->render('EmaRgementBundle:Justify:absence.html.twig', array(
            'students' =>  $students,
            'studentId' => intval($studentId),
            'absenceId' => intval($absenceId)
        ));
    }

    public function justifyDelayAction()
    {
        return $this->render('EmaRgementBundle:Justify:delay.html.twig');
    }


    public function ajaxListAbsencesToJustifyAction()
    {
        $this->justifyService = $this->get('justify_service');
        $reports = $this->justifyService->getAbsencesToJustify();

        $output = array(
            'aaData' => array()
        );

        $response = new JsonResponse();

        foreach ($reports as $report)
        {
            foreach ($report->getAbsences() as $absence)
            {
                $output['aaData'][] = array(
                    'firstName' => $report->getStudent()->getPrenom(),
                    'lastName' => $report->getStudent()->getNom(),
                    'startDate' => $absence->getDateDebut()->format('d/m/Y H:i'),
                    'endDate' => $absence->getDateFin()->format('d/m/Y H:i'),
                    'actionUrl' => $this->generateUrl('ema_rgement_justify_absence', array(
                        'studentId' => $report->getStudent()->getId(),
                        'absenceId' => $absence->getId(),
                )));
            }
        }

        $response->setData($output);

        return $response;
    }

    public function ajaxListAbsencesToJustifyForAStudentAction() {
        $studendId = intval($this->get('request')->get('studentId'));

        $absencesForAStudent = $students = $this->getDoctrine()
            ->getRepository('EmaRgementBundle:Absence')
            ->findAllForAStudent($studendId);

        $response = new JsonResponse();
        $result = array();

        foreach ($absencesForAStudent as $absence) {
            $result[] = array(
                'startDate' => $absence->getDateDebut()->format('d/m/Y H:i'),
                'endDate' => $absence->getDateFin()->format('d/m/Y H:i'),
                'id' => $absence->getId()
            );
        }

        $response->setData($result);

        return $response;
    }
}
