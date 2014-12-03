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

    public function justifyAbsenceAction()
    {
        $students = $this->getDoctrine()
            ->getRepository('EmaRgementBundle:Etudiant')
            ->findAll();

        return $this->render('EmaRgementBundle:Justify:absence.html.twig', array(
            'students' =>  $students
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
                    'actionUrl' => $this->generateUrl('ema_rgement_justify_absence')
                );
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
