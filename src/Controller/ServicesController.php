<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class ServicesController extends AbstractController
{

    public function servicesAction($type) {
        if(!$type) {
            return $this->container['twig']->render('services.html.twig', array('active_page' => 'services'));
        } else {
            return $this->serviceByType($type);
        }
    }

    private function serviceByType($type) {
        switch($type) {
            case 'semanal':
                return $this->weeklyService();
            default:
                return $this->container['twig']->render('services.html.twig', array('active_page' => 'services'));
        }
    }

    private function weeklyService() {
        return $this->container['twig']->render('services/weekly_service.html.twig', array('active_page' => 'services'));
    }


    public function promoServicesAction($type) {
        return $this->promoServiceByType($type);
    }

    private function promoServiceByType($type) {
        switch($type) {
            case 'lanzamiento':
                return $this->firstPromoService();
            default:
                return $this->container['twig']->render('services.html.twig', array('active_page' => 'services'));
        }
    }

    private function firstPromoService() {
        return $this->container['twig']->render('services/promos/launch.html.twig', array('active_page' => 'services'));
    }

}
