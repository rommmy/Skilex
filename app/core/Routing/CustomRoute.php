<?php

namespace Core\Routing;

use Silex\Route;

/**
 * Custom Route definition that allows
 * us to use the "template" tag when defining routes
 * within our controller providers
 *
 * @package default
 */
class CustomRoute extends Route
{
    public function template($path)
    {
        $this->setOption('_template', $path);
        return $this;
    }
}
