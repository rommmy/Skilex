<?php

namespace Core\Config;

use Silex\Application;

/**
 * Config class loader.
 *
 * @package default
 */
class Loader
{
    /** @var array environment class map */
    protected static $envMap = [
        'dev' => 'Core\\Config\\Env\\Dev',
        'qualif' => 'Core\\Config\\Env\\Qualif',
        'prod' => 'Core\\Config\\Env\\Prod'
    ];

    /**
     * Load configuration class from current environment
     *
     * @param  Application $app
     * @param  [type]      $env
     * @return [type]
     */
    public static function loadFromEnv(Application $app, $env)
    {
        if (isset(self::$envMap[strtolower($env)])) {
            $class = self::$envMap[strtolower($env)];
            $config = new $class($app);
            $config->register();
        }
    }
}
