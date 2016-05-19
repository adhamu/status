<?php
namespace Status;

use Dotenv\Dotenv;
use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_Extension_Debug;
use GuzzleHttp\Client;

use Status\Service\ConfigService;
use Status\Service\HashedAssetLoadService;
use Status\Service\WebsiteStatusCheckerService;
use Status\Service\ServerStatusCheckerService;

class Container
{
    private $app;

    const CONFIG_FILE = 'config.json';
    const TEMPLATE_DIR = 'resources/views/';

    public function __construct()
    {
        $this->app = new App(
            new ConfigService(self::CONFIG_FILE),
            new Dotenv($_SERVER['DOCUMENT_ROOT']),
            new HashedAssetLoadService,
            new Twig_Environment(new Twig_Loader_Filesystem(self::TEMPLATE_DIR)),
            new Twig_Extension_Debug,
            new WebsiteStatusCheckerService(new Client),
            new ServerStatusCheckerService
        );
    }

    public function get()
    {
        return $this->app;
    }
}
