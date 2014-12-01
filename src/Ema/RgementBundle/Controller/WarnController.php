<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ema\RgementBundle\Entity\Warn;
use Ema\RgementBundle\Entity\Retard;
use Ema\RgementBundle\Form\WarnType;

class WarnController extends Controller
{

    private $participationService ;

    /*public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->initialize();
    }

    public function initialize()
    {
        $this->participationService = $this->get('participation_service');
    }*/

    public function warnAbsenceAction(Request $request)
    {
        $entity = new Warn();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);


        return $this->render('EmaRgementBundle:Warn:absence.html.twig', array('form' => $form->createView(),));
    }

    public function warnDelayAction(Request $request)
    {
        $entity = new Warn();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

		if ($form->isValid()) {
           // $this->participationService->create($form->
            
            $delay = new Retard();
            $delay->setIdParticipation($this->get('participation_service')->create(1,1));
            $delay->setNomEleve($form->nomEleve);
            $delay->setRetardHour($form->retardHour);
            $delay->setRetardDate($form->retardDate);

			$em = $this->getDoctrine()->getManager();
			$em->persist($delay);
			$em->flush();
		}
        return $this->render('EmaRgementBundle:Warn:delay.html.twig', array('form' => $form->createView(),));
    }

    /**
     * Creates a form to create a Retard entity.
     *
     * @param Retard $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Warn $entity)
    {
        $form = $this->createForm(new WarnType(), $entity, array(
            'action' => $this->generateUrl('ema_rgement_warn_delay'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
}
