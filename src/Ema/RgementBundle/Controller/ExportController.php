<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExportController extends Controller
{

    private $excelService;
    private $reportService;
    private $promotionRepository;

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->initialize();
    }

    private function initialize()
    {
        $this->excelService = $this->get('excel_service');
        $this->reportService = $this->get('report_service');
        $this->promotionRepository = $this->getDoctrine()->getRepository("EmaRgementBundle:Promotion");
    }

    public function listAction()
    {
        $from = new \DateTime('first day of last month');
        $to = new \DateTime('last day of last month');
        return $this->render('EmaRgementBundle:Export:list.html.twig',
                array(
                'from' => $from->format('d/m/Y'),
                'to' => $to->format('d/m/Y'),
                'promos' => $this->promotionRepository->findAll()
        ));
    }

    public function ajaxListExportsAction()
    {
        $from = $this->get('request')->request->get('from');
        $to = $this->get('request')->request->get('to');
        $promoId = intval($this->get('request')->request->get('promoId'));
        $error = false;

        if (empty($from) || empty($to) || empty($promoId) || $promoId === 0)
        {
            $error = true;
        }

        $response = new JsonResponse();
        $output = array(
            'aaData' => array()
        );
        if (!$error)
        {

        }


        $response->setData($output);

        return $response;
    }

    public function exportAction($studentId, $promoId, $dateFrom, $dateTo)
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

        $report = $this->reportService->getAbsencesForStudentIdBetweenDates(intval($studentId), $promoId, $from, $to);
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

        if (count($absences) != 0)
        {
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
        }
        else
        {
            $rowNumber = 13;
        }

        $retards = $report->getRetards();

        $absencesLines = count($absences) - 1;
        if (count($absences) == 0)
        {
            $absencesLines = 0;
        }
        $phpExcelObject->getActiveSheet()
            ->setCellValue('B' . (15 + $absencesLines), count($retards));

        if (count($retards) != 0)
        {
            $phpExcelObject->getActiveSheet()->insertNewRowBefore(18 + $absencesLines + 1, count($retards));
            foreach ($retards as $retard)
            {
                /* @var $retard \Ema\RgementBundle\Entity\Retard */
                $rowNumber = 18 + $absencesLines + $newRetardsRows;
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
        }

        $this->excelService->setProperties('EMA', 'EMA', 'Export_test');

        return $this->excelService->export('Export_test');
    }

}
