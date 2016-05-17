<?php
namespace Status;

class Manager
{
    private $environmentLoader;

    public function __construct(EnvironmentLoader $environmentLoader)
    {
        $this->environmentLoader = $environmentLoader;

        echo '<pre>';
        print_r( $this->environmentLoader->getEnv() );
        echo '</pre>';
    }
}
