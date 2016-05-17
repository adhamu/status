<?php
namespace Status;

use Status\EnvironmentLoader;

class Container
{
    public function __construct()
    {
        $manager = new Manager(
            new EnvironmentLoader
        );
    }
}
