<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ema\RgementBundle\Entity\Cours;
use Ema\RgementBundle\Entity\CoursGroup;

class ReportController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repoCours = $em->getRepository('EmaRgementBundle:Cours');
        $arrayCoursGroup = array();
        $i = 0;
        
        $coursGroup = new CoursGroup();
        foreach ($repoCours->findAllOrderByDate() as $c) {
            $dateGroup = $coursGroup->getDateCours();
            $dateCours = $c->getDateDebut();
            if ($dateGroup <> NULL && date_format($dateGroup, 'Y-m-d') == date_format($dateCours,'Y-m-d')) 
            {
                $coursGroup->addCours($c);
            } else {
                $coursGroup = new CoursGroup();
                $coursGroup->setDateCours($c->getDateDebut());
                $coursGroup->addCours($c);
                $i++;
            }
            
            $arrayCoursGroup[$i] = $coursGroup ;
        }
        return $this->render('EmaRgementBundle:Report:list.html.twig', array(
            'listCoursGroup' => $arrayCoursGroup,
            ));    
    }

    public function showAction($id)
    {
        if ($id <= 0)
        {
            return $this->listAction();
        }
        return $this->render('EmaRgementBundle:Report:show.html.twig', array(
                // ...
            ));    }

}
