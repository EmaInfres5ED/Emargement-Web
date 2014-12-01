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
        $from = new \DateTime($dateFrom);
        $to = new \DateTime($dateTo);

        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('C1', $studentId)
            ->setCellValue('C5', $from->format("d/m/Y"))
            ->setCellValue('C6', $to->format("d/m/Y"));

        //TODO retrieve data from BDD to fill all the template
        //Wipe the template data

        $this->excelService->setProperties('EMA', 'EMA', 'Export_test');

        return $this->excelService->export('Export_test');
    }

}
