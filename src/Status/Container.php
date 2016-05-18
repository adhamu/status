<?php
namespace Status;

use josegonzalez\Dotenv\Loader;
use Status\Service\HashedAssetLoadService;
use Twig_Loader_Filesystem;
use Twig_Environment;

class Container
{
    private $app;

    const ENV = '.env';
    const TEMPLATE_DIR = 'resources/templates/';

    public function __construct()
    {
        $twigLoader = new Twig_Loader_Filesystem(self::TEMPLATE_DIR);

        $this->app = new App(
            new Loader(self::ENV),
            new HashedAssetLoadService,
            new Twig_Environment($twigLoader)
        );
    }

    public function get()
    {
        return $this->app;
    }
}
