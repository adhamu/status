<?php
namespace Status;

use Dotenv\Dotenv;
use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_Extension_Debug;
use GuzzleHttp\Client;

use Status\Components\CommandRunner;

use Status\Service\ConfigService;
use Status\Service\HashedAssetLoadService;
use Status\Service\WebsiteStatusCheckerService;
use Status\Service\ServerStatusCheckerService;
use Status\Service\SystemCheckerService;

class Container
{
    private $app;

    const CONFIG_FILE = 'config.json';
    const STYLESHEET = 'styles.min.css';
    const SCRIPT_FILE = 'script.min.js';
    const TEMPLATE_DIR = 'resources/views/';

    public function __construct()
    {
        $this->app = new App(
            new ConfigService(self::CONFIG_FILE),
            self::STYLESHEET,
            self::SCRIPT_FILE,
            new Dotenv($_SERVER['DOCUMENT_ROOT']),
            new HashedAssetLoadService,
            new Twig_Environment(new Twig_Loader_Filesystem(self::TEMPLATE_DIR), [
                'debug' => true
            ]),
            new Twig_Extension_Debug,
            new WebsiteStatusCheckerService(new Client),
            new ServerStatusCheckerService(new CommandRunner),
            new SystemCheckerService(new CommandRunner)
        );
    }

    public function get(): App
    {
        return $this->app;
    }
}
