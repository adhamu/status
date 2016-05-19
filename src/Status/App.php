<?php
namespace Status;

use Dotenv\Dotenv;
use Twig_Environment;
use Twig_Extension_Debug;

use Status\Service\HashedAssetLoadService;
use Status\Service\WebsiteStatusCheckerService;
use Status\Service\ServerStatusCheckerService;

class App
{
    private $environmentLoader;
    private $assetLoader;
    private $twigEnvironment;
    private $websiteStatusCheckerService;
    private $serverStatusCheckerService;

    public function __construct(
        Dotenv $environmentLoader,
        HashedAssetLoadService $assetLoader,
        Twig_Environment $twigEnvironment,
        WebsiteStatusCheckerService $websiteStatusCheckerService,
        ServerStatusCheckerService $serverStatusCheckerService
    ) {
        $this->environmentLoader = $environmentLoader;
        $this->environmentLoader->load();

        $this->assetLoader = $assetLoader;
        $this->twigEnvironment = $twigEnvironment;
        $this->twigEnvironment->addExtension(new Twig_Extension_Debug());
        $this->websiteStatusCheckerService = $websiteStatusCheckerService;
        $this->serverStatusCheckerService = $serverStatusCheckerService;
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

    public function getStylesheetFilename()
    {
        return $this->assetLoader->loadResource('styles.min.css');
    }

    public function getScriptFilename()
    {
        return $this->assetLoader->loadResource('script.min.js');
    }

    public function getTwigEnvironment()
    {
        return $this->twigEnvironment;
    }

    public function getWebsiteStatusCheckerService()
    {
        return $this->websiteStatusCheckerService;
    }

    public function getServerStatusCheckerService()
    {
        return $this->serverStatusCheckerService;
    }

    public function getSiteStatuses()
    {
        $siteStatuses = [];

        foreach ($this->getEndpoints() as $key => $e) {
            $siteStatuses[] = [
                'name' => $e['name'],
                'endpoint' => $e['url'],
                'status' => $this->getWebsiteStatusCheckerService()->checkUrl($e['url'])
            ];
        }

        return $siteStatuses;
    }

    public function getServerServiceStatuses()
    {
        $serverServiceStatuses = [];

        foreach ($this->getServerServices() as $key => $s) {
            $serverServiceStatuses[] = [
                'name' => $s['name'],
                'service' => $s['service'],
                'status' => $this->getServerStatusCheckerService()->checkService($s['command'])
            ];
        }

        return $serverServiceStatuses;
    }

    private function getEndpoints()
    {
        return [
            [
                "name" => "Amit Dhamu Main Website",
                "url" => "https://amitd.co"
            ],
            [
                "name" => "Formula 1 Result Finder",
                "url" => "https://amitd.co/f1/"
            ],
            [
                "name" => "IronReader",
                "url" => "https://amitd.co/ironreader/"
            ],
            [
                "name" => "Ergast Motorsport Developer API",
                "url" => "http://ergast.com/api/f1"
            ],
            [
                "name" => "LastFM API",
                "url" => "http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user={$this->getEnvParam('LAST_FM_USERNAME')}&api_key={$this->getEnvParam('LAST_FM_API_KEY')}&format=json"
            ]
        ];
    }

    private function getServerServices()
    {
        return [
            [
                "name" => "Apache",
                "service" => "httpd",
                "command" => "cat /var/run/httpd/httpd.pid"
            ],
            [
                "name" => "MySQL",
                "service" => "mysqld",
                "command" => "cat /var/run/mysqld/mysqld.pid"
            ],
        ];
    }
}
