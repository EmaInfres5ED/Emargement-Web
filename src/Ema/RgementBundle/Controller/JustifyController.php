<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class JustifyController extends Controller
{
    private $justifyService;

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
                    'startDate' => $absence->getDateDebut(),
                    'endDate' => $absence->getDateFin(),
                    'actionUrl' => null
                );
            }
        }

        $response->setData($output);

        return $response;
    }
}
