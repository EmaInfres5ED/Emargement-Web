<?php

namespace Ema\RgementBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ReportService extends Controller
{

    private $courseRepo;
    private $delayRepo;
    private $absenceRepo;

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->initialize();
    }

    private function initialize()
    {
        $this->courseRepo = $this->getDoctrine()->getRepository("EmaRgementBundle:Cours");
        $this->delayRepo = $this->getDoctrine()->getRepository("EmaRgementBundle:Retard");
//        $this->absenceRepo = $this->getDoctrine()->getRepository("EmaRgementBundle:Absence");
    }

    public function getAll($start = 0, $end = 0)
    {
        $result = array();
        $result[] = $this->getOne(1);
        $result[] = $this->getOne(2);
        return null;
    }

    public function getOne($id)
    {
        $result = null;
        if (intval($id) > 0)
        {
            $result = new \Ema\RgementBundle\Entity\Report;
            $result->setCourse($this->courseRepo->find($id));
            $result->setDelays($this->delayRepo->getByCourse($id));
            $result->setAbsences($this->absenceRepo->getByCourse($id));
        }
        return $result;
    }

}
