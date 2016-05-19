<?php
namespace Status;

use Dotenv\Dotenv;
use Twig_Loader_Filesystem;
use Twig_Environment;
use GuzzleHttp\Client;

use Status\Service\HashedAssetLoadService;
use Status\Service\WebsiteStatusCheckerService;

class Container
{
    private $app;

    const TEMPLATE_DIR = 'resources/views/';

    public function __construct()
    {
        $this->app = new App(
            new Dotenv($_SERVER['DOCUMENT_ROOT']),
            new HashedAssetLoadService,
            new Twig_Environment(new Twig_Loader_Filesystem(self::TEMPLATE_DIR)),
            new WebsiteStatusCheckerService(new Client)
        );
    }

    public function get()
    {
        return $this->app;
    }
}
