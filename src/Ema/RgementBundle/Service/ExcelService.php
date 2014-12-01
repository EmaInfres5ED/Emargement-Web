<?php

namespace Ema\RgementBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExcelService extends Controller
{

    private $phpExcelObject;

    public function createFromTemplate($templateName)
    {
        $this->phpExcelObject = $this->get('phpexcel')->createPHPExcelObject(__DIR__ . "/../Template/$templateName.xls");

        $this->phpExcelObject->setActiveSheetIndex(0);

        return $this->phpExcelObject;
    }

    public function create()
    {
        $this->phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $this->phpExcelObject->setActiveSheetIndex(0);

        return $this->phpExcelObject;
    }

    public function setProperties($creatorName, $modifiedBy, $title, $subject = null, $description = null,
        $keywords = null, $category = null)
    {
        $this->phpExcelObject->getProperties()->setCreator($creatorName)
            ->setLastModifiedBy($modifiedBy)
            ->setTitle($title)
            ->setSubject($subject)
            ->setDescription($description)
            ->setKeywords($keywords)
            ->setCategory($category);
    }

    public function export($fileName)
    {
        // create the writer
        $writer = $this->get('phpexcel')->createWriter($this->phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=' . $fileName . '.xls');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response;
    }

}
