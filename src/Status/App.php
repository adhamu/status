<?php
namespace Status;

use josegonzalez\Dotenv\Loader;

class App
{
    private $environmentLoader;

    public function __construct(Loader $environmentLoader)
    {
        $this->environmentLoader = $environmentLoader;
        $this->environmentLoader->parse();
        $this->environmentLoader->toEnv();
    }

    public function getEnv()
    {
        return $_ENV;
    }

    public function getEnvParam($param)
    {
        $env = $this->getEnv();

        return $env[$param];
    }
}
