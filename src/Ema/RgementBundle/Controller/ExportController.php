<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ExportController extends Controller
{

    private $excelService;
    private $reportService;

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->initialize();
    }

    private function initialize()
    {
        $this->excelService = $this->get('excel_service');
        $this->reportService = $this->get('report_service');
    }

    public function listAction()
    {
        return $this->render('EmaRgementBundle:Default:export.html.twig');
    }

    public function exportAction($studentId, $dateFrom, $dateTo)
    {
        $phpExcelObject = $this->excelService->createFromTemplate('export_template');
        /* @var $phpExcelObject \PHPExcel */
        $from = new \DateTime($dateFrom);
        $to = new \DateTime($dateTo);
        $newAbsencesRows = 0;
        $newRetardsRows = 0;
        $rowNumber = 0;

        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('I1', $from->format("d/m/Y"))
            ->setCellValue('I2', $to->format("d/m/Y"));

        //TODO retrieve data from BDD

        $report = $this->reportService->getAbsencesForStudentIdBetweenDates(intval($studentId), $from, $to);
        /* @var $report \Ema\RgementBundle\Entity\Report */

        $promotion = $report->getPromotion();
        /* @var $student \Ema\RgementBundle\Entity\Promotion */

        $student = $report->getStudent();
        /* @var $student \Ema\RgementBundle\Entity\Etudiant */
        $phpExcelObject->getActiveSheet()
            ->setCellValue('B1', $student->getId())
            ->setCellValue('B2', $student->getNom())
            ->setCellValue('B3', $student->getPrenom())
            ->setCellValue('B4', $promotion->getLibelle())
            ->setCellValue('B5', $student->getEmail());

        $absences = $report->getAbsences();

        $phpExcelObject->getActiveSheet()
            ->setCellValue('B9', count($absences));


        $phpExcelObject->getActiveSheet()->insertNewRowBefore(13, count($absences));
        foreach ($absences as $absence)
        {
            /* @var $absence \Ema\RgementBundle\Entity\Absence */
            $rowNumber = 12 + $newAbsencesRows;
            $newAbsencesRows++;
            $phpExcelObject->getActiveSheet()->mergeCells("B$rowNumber:C$rowNumber");
            $phpExcelObject->getActiveSheet()->mergeCells("D$rowNumber:E$rowNumber");
            $phpExcelObject->getActiveSheet()->mergeCells("F$rowNumber:I$rowNumber");

            $phpExcelObject->getActiveSheet()
                ->setCellValue("A$rowNumber", $newAbsencesRows)
                ->setCellValue("B$rowNumber", $absence->getDateDebut()->format("d/m/Y"))
                ->setCellValue("D$rowNumber", $absence->getDateFin()->format("d/m/Y"))
                ->setCellValue("F$rowNumber", $absence->getMotif());
        }
        $phpExcelObject->getActiveSheet()->removeRow($rowNumber + 1, 1);

        $retards = $report->getRetards();

        $phpExcelObject->getActiveSheet()
            ->setCellValue('B' . (15 + count($absences) - 1), count($retards));

        $phpExcelObject->getActiveSheet()->insertNewRowBefore(18 + count($absences), count($retards));
        foreach ($retards as $retard)
        {
            /* @var $retard \Ema\RgementBundle\Entity\Retard */
            $rowNumber = 18 + count($absences) - 1 + $newRetardsRows;
            $newRetardsRows++;
            $phpExcelObject->getActiveSheet()->mergeCells("B$rowNumber:D$rowNumber");
            $phpExcelObject->getActiveSheet()->mergeCells("F$rowNumber:I$rowNumber");

            $phpExcelObject->getActiveSheet()
                ->setCellValue("A$rowNumber", $newRetardsRows)
                ->setCellValue("B$rowNumber", $retard->getDateprevu()->format("d/m/Y H:i:s"))
                ->setCellValue("E$rowNumber", $retard->getDureeRetard() . ' min')
                ->setCellValue("F$rowNumber", $retard->getMotif());
        }
        $phpExcelObject->getActiveSheet()->removeRow($rowNumber + 1, 1);

        $this->excelService->setProperties('EMA', 'EMA', 'Export_test');

        return $this->excelService->export('Export_test');
    }

}
