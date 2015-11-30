<?php

namespace Component\Home;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * Home Controller Service Provider
 *
 * We provide here the definition of the home controller
 * and it's dependecies
 *
 * @package default
 */
class HomeControllerProvider implements
    ServiceProviderInterface,
    ControllerProviderInterface
{
    public function register(Application $app)
    {
        $app['home.controller'] = $app->share(function() use ($app) {
            return new Controller\HomeController();
        });
    }

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers
            ->get('/', 'home.controller:getIndex')
            ->bind('homepage')
            ->template('Home/View/index.html')
        ;

        return $controllers;
    }

    public function boot(Application $app)
    {
    }
}