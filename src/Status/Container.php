<?php
namespace Status;

use josegonzalez\Dotenv\Loader;
use Status\Services\HashedAssetLoadService;

class Container
{
    private $app;

    const ENV = '.env';

    public function __construct()
    {
        $this->app = new App(
            new Loader(self::ENV),
            new HashedAssetLoadService
        );
    }

    public function get()
    {
        return $this->app;
    }
}
