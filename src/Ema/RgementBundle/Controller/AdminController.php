<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ema\RgementBundle\Entity\Message;

class AdminController extends Controller
{
    public function ajaxSynchronizeStudentsAndPromosAction()
    {
        $response = new JsonResponse();
        $response->setData(array(
            'type' => Message::TYPE_SUCCESS,
            'message' => '<insert message HERE>'
        ));

        return $response;
    }
}
