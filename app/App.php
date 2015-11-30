<?php

use Silex\Application as BaseApp;
use Symfony\Component\HttpFoundation\Response;

/**
 * Application class
 *
 * @package default
 */
class App extends BaseApp
{
    public function __construct()
    {
        parent::__construct();

        $this->configure();
        $this->mountRoutes();
    }

    /**
     * Configure the application
     * based on the current environment
     *
     * @return type
     */
    protected function configure()
    {
        $env = getenv('ENV');

        \Core\Config\Loader::loadFromEnv($this, $env);
    }

    /**
     * Mounts given patterns to specific
     * Controller Service
     *
     * @return type
     */
    protected function mountRoutes()
    {
        $home = new Component\Home\HomeControllerProvider();

        $this
            ->register($home)
        ;

        $this
            ->mount('/', $home)
        ;

        // Error handling
        $app = $this;
        $this->error(function (\Exception $e, $code) use ($app) {
            if ($app['debug']) {
                return;
            }

            // 404.html, or 40x.html, or 4xx.html, or error.html
            $templates = array(
                'errors/'.$code.'.html',
                'errors/'.substr($code, 0, 2).'x.html',
                'errors/'.substr($code, 0, 1).'xx.html',
                'errors/default.html',
            );

            return new Response(
                $app['twig']->resolveTemplate($templates)->render(['code' => $code]),
                $code
            );
        });
    }
}