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
        return $this->container['twig']->render('contact.html.twig', array('active_page' => 'contact'));
    }
}
