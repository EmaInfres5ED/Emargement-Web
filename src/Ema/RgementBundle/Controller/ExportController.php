<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ExportController extends Controller
{

    private $excelService;

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->initialize();
    }

    private function initialize()
    {
        $this->excelService = $this->get('excel_service');
    }

    public function listAction()
    {
        return $this->render('EmaRgementBundle:Default:export.html.twig');
    }

    public function exportAction($studentId, $dateFrom, $dateTo)
    {
        $phpExcelObject = $this->excelService->createFromTemplate('export_template');

        $this->excelService->setProperties('EMA', 'EMA', 'Export_test');

        return $this->excelService->export('Export_test');
    }

}
