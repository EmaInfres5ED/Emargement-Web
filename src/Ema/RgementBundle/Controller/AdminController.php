<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ema\RgementBundle\Entity\Message;

class AdminController extends Controller
{
    private $cronController;

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->initialize();
    }

    private function initialize()
    {
        $this->cronController = $this->get('cron_controller_service');
    }

    public function ajaxSynchronizeStudentsAndPromosAction()
    {
        $response = new JsonResponse();

        $this->cronController = $this->get('cron_controller_service');
        if ($this->cronController->updateAll()) {
            $response->setData(array(
                'type' => Message::TYPE_SUCCESS,
                'message' => 'Mise à jour des étudiants et des promos effectuée avec succès.'
            ));
        } else {
            $response->setData(array(
                'type' => Message::TYPE_ERROR,
                'message' => 'Echec de la mise à jour des étudiants et des promos.'
            ));
        }

        return $response;
    }

    public function ajaxSynchronizeCoursesAction()
    {
        $response = new JsonResponse();

        $this->cronController = $this->get('cron_controller_service');
        if ($this->cronController->updateFirstJson()) {
            $response->setData(array(
                'type' => Message::TYPE_SUCCESS,
                'message' => 'Mise à jour des cours effectuée avec succès.'
            ));
        } else {
            $response->setData(array(
                'type' => Message::TYPE_ERROR,
                'message' => 'Echec de la mise à jour des cours.'
            ));
        }

        return $response;
    }
}
