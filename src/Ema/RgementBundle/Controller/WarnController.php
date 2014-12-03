<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ema\RgementBundle\Entity\Warn;
use Ema\RgementBundle\Entity\Retard;
use Ema\RgementBundle\Entity\Cours;
use Ema\RgementBundle\Entity\Etudiant;
use Ema\RgementBundle\Entity\Participation;
use Ema\RgementBundle\Entity\Promotion;
use Ema\RgementBundle\Entity\Absence;
use Ema\RgementBundle\Form\WarnType;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

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

        if ($form->isValid()) {
            try {
                $student = $this->getDoctrine()->getRepository('EmaRgementBundle:Etudiant')->find($form["nomEleve"]->getData());

                $absence = new Absence();
                $absence->setEleve($student);
                $absence->setDateDebut($form["absenceDateDebut"]->getData());
                $absence->setDateFin($form["absenceDateFin"]->getData());
                $absence->setMotif($form["motif"]->getData());

			    $em = $this->getDoctrine()->getManager();
			    $em->persist($absence);
			    $em->flush();
                
                return $this->render('EmaRgementBundle:Default:success.html.twig');
            } catch (Exception $e) {
                return $this->render('EmaRgementBundle:Default:fail.html.twig');
            }
		}
        return $this->render('EmaRgementBundle:Warn:absence.html.twig', array('form' => $form->createView(),));
    }

    public function warnDelayAction(Request $request)
    {
        $entity = new Warn();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

		if ($form->isValid()) {
            try {
                $cours = $this->getDoctrine()->getManager()->getRepository('EmaRgementBundle:Cours')->find(1);
                $student = $this->getDoctrine()->getRepository('EmaRgementBundle:Etudiant')->find(1065);
                $participation = $this->get('participation_service')->create($cours, $student);

                $delay = new Retard();
                $delay->setParticipation($participation);
                $delay->setEtudiant($student);
                $delay->setDatePrevu($form["retardDate"]->getData());
                $time = $form["retardHour"]->getData();
                $retardMinute = $time->format("g") * 60 + $time->format("i");
                $delay->setDureeRetard($retardMinute);
                $delay->setMotif($form["motif"]->getData());

			    $em = $this->getDoctrine()->getManager();
			    $em->persist($delay);
			    $em->flush();
                
                return $this->render('EmaRgementBundle:Default:success.html.twig');
            } catch (Exception $e) {
                return $this->render('EmaRgementBundle:Default:fail.html.twig');
            }
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
            'action' => $this->generateUrl('ema_rgement_warn_absence'),
            'method' => 'POST',
        ));
        $i = 0;
        $arrayEleve = array();
        $student = new Etudiant();

        foreach ($this->get('cron_controller_service')->getEtudiants() as $s) {
            $arrayEleve[$s->getId()] = $s->getPrenom() . ' ' . $s->getNom() /*. ' - ' . $this->getDoctrine()->getRepository('EmaRgementBundle:Promotion')->find($s->getIdCybema()->getLibelle())*/;
        }
        $form->add('nomEleve', 'choice', array('choice_list' => new SimpleChoiceList($arrayEleve)));

        return $form;
    }
}
