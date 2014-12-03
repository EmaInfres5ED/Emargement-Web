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

    public function listAction()
    {
        $notificationByDays = array();
        foreach ($this->notificationRepository->findAll() as $notification)
        {
            /* @var $notification Ema\RgementBundle\Entity\Notification */
            $notificationByDays[$notification->getDate()->format('d/m/Y')][] = $notification;
        }
        return $this->render('EmaRgementBundle:Notification:list.html.twig',
                array(
                'notifications' => $notificationByDays
        ));
    }

    public function ajaxGetNotificationsAction()
    {
        $response = new JsonResponse();

        $result = array();

        foreach ($this->notificationRepository->findBySaw(false) as $notification)
        {
            /* @var $notification Ema\RgementBundle\Entity\Notification */
            $courseId = 0;
            $courseName = '';
            $startDate = '';
            $endDate = '';
            if ($notification->getCours() != null)
            {
                $courseId = $notification->getCours()->getId();
                $courseName = $notification->getCours()->getLibelle();
                $startDate = $notification->getCours()->getDateDebut()->format("h:i");
                $endDate = $notification->getCours()->getDateFin()->format("h:i");
            }

            $result[] = array(
                'id' => $notification->getId(),
                'content' => $notification->getContent(),
                'courseId' => $courseId,
                'courseName' => $courseName,
                'startDate' => $startDate,
                'endDate' => $endDate
            );
        }

        $response->setData($result);

        return $response;
    }

    public function ajaxMarkANotificationSawAction()
    {
        $response = new JsonResponse();

        $notificationId = $this->get('request')->get('notificationId');
        $notification = $this->notificationRepository->findOneById($notificationId);

        if (!empty($notification))
        {
            $notification->setSaw(true);
            $this->entityManager->flush();
            $response->setData(array(
                'type' => Message::TYPE_SUCCESS,
                'message' => 'Mise à jour de la notification avec succès.'
            ));
        }
        else
        {
            $response->setData(array(
                'type' => Message::TYPE_ERROR,
                'message' => 'Erreur lors de la mise à jour de la notification.'
            ));
        }

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
