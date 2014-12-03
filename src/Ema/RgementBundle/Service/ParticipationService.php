<?php

namespace Ema\RgementBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ema\RgementBundle\Entity\Participation;

class ParticipationService extends Controller
{
    public function create($cours, $student) {
        $participation = new Participation();
        $participation->setCours($cours);
        $participation->setEtudiant($student);

        $em = $this->getDoctrine()->getManager();
        $em->persist($participation);
        $em->flush();
        
        return $participation;
    }
}

