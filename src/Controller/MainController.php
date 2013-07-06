<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class MainController extends AbstractController
{

    public function homeAction() {
        return $this->container['twig']->render('home.html.twig', array('active_page' => 'home'));
    }

    public function pointsAction() {
        return $this->container['twig']->render('points.html.twig', array('active_page' => 'points'));
    }

    public function workWithUsAction() {
        return $this->container['twig']->render('workwithus.html.twig', array('active_page' => 'workwithus'));
    }

    public function contactUsAction() {
        $form = $this->container['form.factory']->createBuilder('form')
            ->add('name')
            ->add('email')
            ->add('phone')
            ->add('message')
            ->getForm();

        if ('POST' == $this->container['request']->getMethod()) {
            $form->bind($this->container['request']);

            $data = $form->getData();

            if ($form->isValid()) {
                $data = $form->getData();

                // do something with the data
                $message = \Swift_Message::newInstance()
                    ->setSubject('[Hoduho] '.$data['name'].' ha hecho una consulta')
                    ->setFrom(array($data['email']))
                    ->setTo(array('gabriel.anglada@gmail.com'))
                    ->setBody($data['message']);

                $this->container['mailer']->send($message);

                // redirect somewhere
                return $this->container['twig']->render('contact/contact_success.html.twig', array('active_page' => 'contact'));
            }
        }

        // display the form
        return $this->container['twig']->render('contact.html.twig', array('active_page' => 'contact', 'form' => $form->createView()));
    }
}
