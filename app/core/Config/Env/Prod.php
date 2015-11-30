<?php

namespace Core\Config\Env;

use Silex\Application;
use Silex\Provider\WebProfilerServiceProvider;
use \Core\Config\BaseConfig;

/**
 * PRODUCTION specific configuration class
 *
 * We register here all the required Providers.
 * DO NOT extend or register simple services here,
 * create instead a Service Provider and register it here.
 *
 */
class Prod extends BaseConfig
{
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    public function register()
    {
        $this->app['debug'] = false;
    }
}
