<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class MainController extends AbstractController
{

    public function homeAction() {
        return $this->container['twig']->render('home.html.twig', array('active_page' => 'presentacion'));
    }

    public function pointsAction() {
        return $this->container['twig']->render('points.html.twig', array('active_page' => 'puntos'));
    }

    public function workWithUsAction() {
        $form = $this->container['form.factory']->createBuilder('form')
            ->add('email', 'email')
            ->add('phone', 'text')
            ->add('message', 'textarea')
            ->getForm();

        if ('POST' == $this->container['request']->getMethod()) {
            $form->bind($this->container['request']);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->container['mailer.custom']->sendWorkWithUsMail($data['name'], $data['email'], $data['message']);
                return $this->container['twig']->render('contact/contact_success.html.twig', array('active_page' => 'contact'));
            }
        }
        return $this->container['twig']->render('workwithus.html.twig', array('active_page' => 'trabaja', 'form' => $form->createView()));
    }

    public function contactUsAction() {
        $form = $this->container['form.factory']->createBuilder('form')
            ->add('email', 'email')
            ->add('phone', 'text', array('required' => false))
            ->add('message', 'textarea')
            ->getForm();

        if ('POST' == $this->container['request']->getMethod()) {
            $form->bind($this->container['request']);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->container['mailer.custom']->sendContactMail($data['name'], $data['email'], $data['message']);
                return $this->container['twig']->render('contact/contact_success.html.twig', array('active_page' => 'contact'));
            }
        }
        return $this->container['twig']->render('contact.html.twig', array('active_page' => 'contacta', 'form' => $form->createView()));
    }
}
