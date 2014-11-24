<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ema\RgementBundle\Entity\Message;
use Ema\RgementBundle\Controller\CronController;

class AdminController extends Controller
{
    private $cronController;

    public function ajaxSynchronizeStudentsAndPromosAction()
    {
        $response = new JsonResponse();

        $this->cronController = $this->get('cron_controller_service');
        if ($this->cronController->updateAllAction()) {
            $response->setData(array(
                'type' => Message::TYPE_SUCCESS,
                'message' => 'Mise à jour des étudiants et des promos effectuée avec success.'
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
        if ($this->cronController->updateFirstJsonAction()) {
            $response->setData(array(
                'type' => Message::TYPE_SUCCESS,
                'message' => 'Mise à jour des cours effectuée avec success.'
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
