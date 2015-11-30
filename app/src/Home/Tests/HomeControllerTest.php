<?php

use Silex\WebTestCase;

/**
 * Home Controller test
 *
 * Provides functional testing for the Homepage
 *
 * @see http://silex.sensiolabs.org/doc/testing.html
 * @package default
 */
class HomeControllerTest extends WebTestCase
{
    /**
     * Test homepage
     *
     * @return [type] [description]
     */
    public function testGetHomepage()
    {
        // build our fake browser client
        $client = $this->createClient();
        $client->followRedirects(true);

        // make the request
        $crawler = $client->request('GET', '/');

        // Assertions
        $this->assertTrue($client->getResponse()->isOk());
        $this->assertContains(
            'Artsper back office index',
            $crawler->filter('body')->text()
        );
    }

    /**
     * Create application context for the test
     *
     * @return [type] [description]
     */
    public function createApplication()
    {
        require __DIR__.'/../../../../vendor/autoload.php';
        require __DIR__.'/../../../../app/bootstrap.php';

        date_default_timezone_set('Europe/Paris');

        $app = new ArtsperApp;
        $app['session.test'] = true;
        $app['debug'] = true;
        unset($app['exception_handler']);

        return $this->app = $app;
    }
}