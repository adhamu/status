<?php
namespace Status;

use Status\EnvironmentLoader;

class Container
{
    private $manager;

    public function __construct()
    {
        $this->manager = new Manager(
            new EnvironmentLoader
        );
    }
}
