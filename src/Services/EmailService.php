<?php

namespace Services;

class EmailService
{
    protected $container;

    public function __construct(\Silex\Application $app) {
        $this->container = $app;
    }

    public function sendContactMail($fromName, $fromEmail, $message) {
        $message = \Swift_Message::newInstance()
            ->setSubject('[Hoduho] '.$fromName.' ha hecho una consulta')
            ->setFrom(array($fromEmail))
            ->setTo(array($this->container['infoMail']))
            ->setBody(
                $this->container['twig']->render('mails/contact_template.html.twig', array('message' => $message)),
                'text/html'
        );
        $this->container['mailer']->send($message);
    }

    public function sendWorkWithUsMail($fromName, $fromEmail, $message) {
        $message = \Swift_Message::newInstance()
            ->setSubject('[Hoduho] '.$fromName.' ha solicitado trajar con hoduho')
            ->setFrom(array($fromEmail))
            ->setTo(array($this->container['infoMail']))
            ->setBody(
            $this->container['twig']->render('mails/work_with_us_template.html.twig', array('message' => $message)),
            'text/html'
        );
        $this->container['mailer']->send($message);
    }
}
