<?php
namespace Controller;

use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class AbstractController
{

    /**
     *
     * @var \Silex\Application
     */
    protected $container;



    public function __construct(\Silex\Application $app)
    {
        $this->container = $app;
    }

    /**
     * Gets a service by id.
     *
     * @param string $id The service id
     *
     * @return object The service
     */
    protected function get($id)
    {
        return $this->container[$id];
    }

}