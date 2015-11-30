<?php

namespace Core\Config\Env;

use Silex\Application;
use Silex\Provider\WebProfilerServiceProvider;
use \Core\Config\BaseConfig;

/**
 * DEVELOPMENT specific configuration class
 *
 * We register here all the required Providers.
 * DO NOT extend or register simple services here,
 * create instead a Service Provider and register it here.
 *
 */
class Dev extends BaseConfig
{
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    public function register()
    {
        $this->app['debug'] = true;

        $this->app->register(new WebProfilerServiceProvider(), array(
            'profiler.cache_dir' => APP_ROOT_PATH . '/cache/profiler',
        ));
    }
}