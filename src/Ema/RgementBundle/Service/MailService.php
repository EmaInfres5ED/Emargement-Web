<?php

namespace Ema\RgementBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MailService extends Controller
{
    public function send($from, $to, $subject, $content, $type = 'text/html')
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($content)
            ->setContentType($type);
        $this->get('mailer')->send($message);
    }

}
