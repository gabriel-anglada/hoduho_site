<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class ServicesController extends AbstractController
{

    /**
     * @param $type
     * @return mixed
     *
     * Permanent services
     */
    public function servicesAction($type) {
        if(!$type) {
            return $this->container['twig']->render('services.html.twig', array('active_page' => 'servicios'));
        } else {
            return $this->serviceByType($type);
        }
    }

    private function serviceByType($type) {
        switch($type) {
            case 'semanal':
                return $this->weeklyService();
            case 'quincenal':
                return $this->biweeklyService();
            case 'puntual':
                return $this->punctualService();
            case 'choque':
                return $this->shockService();
            case 'promolanzamiento':
                return $this->launchPromoService();
            default:
                return $this->container['twig']->render('services.html.twig', array('active_page' => 'servicios'));
        }
    }

    private function weeklyService() {
        $form = $this->container['form.factory']->createBuilder('form')
            ->add('email', 'email')
            ->add('phone', 'text', array('required' => false))
            ->getForm();

        return $this->container['twig']->render('services/weekly_service.html.twig',
            array('active_page' => 'servicios', 'active_section' => 'semanal', 'form' => $form->createView())
        );
    }

    private function biweeklyService() {
        $form = $this->container['form.factory']->createBuilder('form')
            ->add('email', 'email')
            ->add('phone', 'text', array('required' => false))
            ->getForm();

        return $this->container['twig']->render('services/biweekly_service.html.twig',
            array('active_page' => 'servicios', 'active_section' => 'quincenal', 'form' => $form->createView())
        );
    }

    private function punctualService() {
        $form = $this->container['form.factory']->createBuilder('form')
            ->add('email', 'email')
            ->add('phone', 'text', array('required' => false))
            ->getForm();

        return $this->container['twig']->render('services/punctual_service.html.twig',
            array('active_page' => 'servicios', 'active_section' => 'puntual', 'form' => $form->createView())
        );
    }

    private function shockService() {
        $form = $this->container['form.factory']->createBuilder('form')
            ->add('email', 'email')
            ->add('phone', 'text', array('required' => false))
            ->getForm();

        return $this->container['twig']->render('services/shock_service.html.twig',
            array('active_page' => 'servicios', 'active_section' => 'choque', 'form' => $form->createView())
        );
    }

    private function launchPromoService() {
        $form = $this->container['form.factory']->createBuilder('form')
            ->add('email', 'email')
            ->add('phone', 'text', array('required' => false))
            ->getForm();

        return $this->container['twig']->render('services/launch_promo_service.html.twig',
            array('active_page' => 'servicios', 'active_section' => 'promolanzamiento', 'form' => $form->createView())
        );
    }

}
