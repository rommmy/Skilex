<?php

namespace Core\Routing;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

/**
 * Custom template rendering listener
 * If the current route has a "template" tag defined,
 * it will use that one
 *
 * @see http://davedevelopment.co.uk/2012/11/26/silex-route-helpers-for-a-cleaner-architecture.html
 * @package default
 */
class TemplateRenderingListener implements EventSubscriberInterface
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $response = $event->getControllerResult();

        if (!is_array($response)) {
            return;
        }

        $request = $event->getRequest();
        $routeName = $request->attributes->get('_route');

        if (!$route = $this->app['routes']->get($routeName)) {
            return;
        }

        if (!$template = $route->getOption('_template')) {
            return;
        }

        $output = $this->app['twig']->render($template, $response);
        $event->setResponse(new Response($output));
    }

    public static function getSubscribedEvents()
    {
        return [KernelEvents::VIEW => ['onKernelView', -10]];
    }
}
