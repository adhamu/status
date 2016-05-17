<?php
namespace Status;

use josegonzalez\Dotenv\Loader as EnvLoader;

class EnvironmentLoader
{
    const ENV = '.env';

    public function __construct()
    {
        $loader = new EnvLoader(self::ENV);
        $loader->parse();
        $loader->toEnv();
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
