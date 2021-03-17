<?php

namespace App;

use Bramus\Router\Router;

/**
 * Class Application
 * @package App
 */
class Application
{
    /**
     * @var Router
     */
    private Router $router;

    /**
     * App constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $this->router->run();
    }
}