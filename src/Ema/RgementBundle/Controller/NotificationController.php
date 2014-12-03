<?php


namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class NotificationController extends Controller
{

    private $notificationRepository;

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->initialize();
    }

    private function initialize()
    {
        $this->notificationRepository = $this->getDoctrine()->getRepository("EmaRgementBundle:Notification");
    }

    public function ajaxGetNotificationsAction()
    {
        $response = new JsonResponse();

        $result = array();

        foreach ($this->notificationRepository->findBySaw(false) as $notification)
        {
            /* @var $notification Ema\RgementBundle\Entity\Notification */
            $result[] = array(
                'id' => $notification->getId(),
                'content' => $notification->getContent()
            );
        }

        $response->setData($result);

        return $response;
    }

}
