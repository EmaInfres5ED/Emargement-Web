<?php


namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ema\RgementBundle\Entity\Message;

class NotificationController extends Controller
{

    private $notificationRepository;
    private $entityManager;

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->initialize();
    }

    private function initialize()
    {
        $this->notificationRepository = $this->getDoctrine()->getRepository("EmaRgementBundle:Notification");
        $this->entityManager = $this->getDoctrine()->getManager();
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

    public function ajaxMarkAllTheNotificationsSawAction()
    {
        $response = new JsonResponse();

        foreach ($this->notificationRepository->findBySaw(false) as $notification)
        {
            /* @var $notification Ema\RgementBundle\Entity\Notification */
            $notification->setSaw(true);
        }

        try
        {
            $this->entityManager->flush();
            $response->setData(array(
                'type' => Message::TYPE_SUCCESS,
                'message' => 'Mise à jour des notifications avec succès.'
            ));
        }
        catch (\Exception $e)
        {
            $response->setData(array(
                'type' => Message::TYPE_ERROR,
                'message' => 'Erreur lors de la mise à jour des notifications.'
            ));
        }

        return $response;
    }

}
