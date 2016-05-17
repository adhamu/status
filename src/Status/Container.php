<?php
namespace Status;

use josegonzalez\Dotenv\Loader;

class Container
{
    private $app;

    const ENV = '.env';

    public function __construct()
    {
        $this->app = new App(
            new Loader(self::ENV)
        );
    }

    public function get()
    {
        return $this->app;
    }
}
