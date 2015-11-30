<?php

namespace Core\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Core\Routing\TemplateRenderingListener;

/**
 * Custom Routing Service Provider extension.
 *
 * We define here our custom route class + our custom
 * template rendering listener
 *
 * @package default
 */
class RoutingServiceProviderExtension implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['route_class'] = 'Core\\Routing\\CustomRoute';
        $app['dispatcher']->addSubscriber(new TemplateRenderingListener($app));
    }

    public function boot(Application $app)
    {
    }
}
