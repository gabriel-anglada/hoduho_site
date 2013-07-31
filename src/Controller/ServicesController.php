<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

use Entity\BaseService;

class ServicesController extends AbstractController
{

    /**
     * @param $type
     * @return mixed
     *
     * Permanent services
     */
    public function servicesAction($type, $duration) {
        if(!$type) {
            return $this->container['twig']->render('services.html.twig', array('active_page' => 'servicios'));
        } else {
            return $this->serviceByType($type, $duration);
        }
    }

    private function serviceByType($type, $duration) {
        switch($type) {
            case 'semanal':
                return $this->weeklyService($duration);
            case 'quincenal':
                return $this->biweeklyService($duration);
            case 'puntual':
                return $this->punctualService($duration);
            case 'choque':
                return $this->shockService($duration);
            case 'promolanzamiento':
                return $this->launchPromoService();
            default:
                return $this->container['twig']->render('services.html.twig', array('active_page' => 'servicios'));
        }
    }

    private function weeklyService($duration) {

        $service = new BaseService();
        $service->setDuration($duration);

        $form = $this->container['form.factory']->createBuilder('form', $service)
            ->add('email', 'email')
            ->add('phone', 'text', array('required' => false))
            ->add('duration', 'integer')
            ->getForm();

        return $this->container['twig']->render('services/weekly_service.html.twig',
            array('active_page' => 'servicios', 'active_section' => 'semanal', 'form' => $form->createView())
        );
    }

    private function biweeklyService($duration) {
        $form = $this->container['form.factory']->createBuilder('form')
            ->add('email', 'email')
            ->add('phone', 'text', array('required' => false))
            ->getForm();

        return $this->container['twig']->render('services/biweekly_service.html.twig',
            array('active_page' => 'servicios', 'active_section' => 'quincenal', 'form' => $form->createView())
        );
    }

    private function punctualService($duration) {
        $form = $this->container['form.factory']->createBuilder('form')
            ->add('email', 'email')
            ->add('phone', 'text', array('required' => false))
            ->getForm();

        return $this->container['twig']->render('services/punctual_service.html.twig',
            array('active_page' => 'servicios', 'active_section' => 'puntual', 'form' => $form->createView())
        );
    }

    private function shockService($duration) {
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
