<?php
namespace Status;

use Dotenv\Dotenv;
use Status\Service\HashedAssetLoadService;
use Twig_Loader_Filesystem;
use Twig_Environment;

class Container
{
    private $app;

    const ENV = '/';
    const TEMPLATE_DIR = 'resources/views/';

    public function __construct()
    {
        $twigLoader = new Twig_Loader_Filesystem(self::TEMPLATE_DIR);
        $this->app = new App(
            new Dotenv($_SERVER['DOCUMENT_ROOT']),
            new HashedAssetLoadService,
            new Twig_Environment($twigLoader)
        );
    }

    public function get()
    {
        return $this->app;
    }
}
