<?php
namespace Status;

use Dotenv\Dotenv;
use Twig_Environment;
use Twig_Extension_Debug;

use Status\Service\ConfigService;
use Status\Service\HashedAssetLoadService;
use Status\Service\WebsiteStatusCheckerService;
use Status\Service\ServerStatusCheckerService;
use Status\Service\SystemCheckerService;

class App
{
    private $configService;
    private $stylesheet;
    private $scriptFile;
    private $environmentLoader;
    private $assetLoader;
    private $twigEnvironment;
    private $websiteStatusCheckerService;
    private $serverStatusCheckerService;
    private $systemCheckerService;

    public function __construct(
        ConfigService $configService,
        $stylesheet,
        $scriptFile,
        Dotenv $environmentLoader,
        HashedAssetLoadService $assetLoader,
        Twig_Environment $twigEnvironment,
        Twig_Extension_Debug $twigDebug,
        WebsiteStatusCheckerService $websiteStatusCheckerService,
        ServerStatusCheckerService $serverStatusCheckerService,
        SystemCheckerService $systemCheckerService
    ) {
        $this->configService = $configService;
        $this->stylesheet = $stylesheet;
        $this->scriptFile = $scriptFile;
        $this->environmentLoader = $environmentLoader;
        $this->environmentLoader->load();

        $this->assetLoader = $assetLoader;
        $this->twigEnvironment = $twigEnvironment;
        $this->twigEnvironment->addExtension($twigDebug);
        $this->websiteStatusCheckerService = $websiteStatusCheckerService;
        $this->serverStatusCheckerService = $serverStatusCheckerService;
        $this->systemCheckerService = $systemCheckerService;
    }

    public function getConfig(): array
    {
        return $this->configService->loadConfig();
    }

    public function getEnv(): array
    {
        return $_ENV;
    }

    public function getEnvParam($param): string
    {
        $env = $this->getEnv();

        return $env[$param];
    }

    public function getStylesheetFilename(): string
    {
        return $this->assetLoader->loadResource($this->stylesheet);
    }

    public function getScriptFilename(): string
    {
        return $this->assetLoader->loadResource($this->scriptFile);
    }

    public function getTwigEnvironment(): Twig_Environment
    {
        return $this->twigEnvironment;
    }

    public function getWebsiteStatusCheckerService(): WebsiteStatusCheckerService
    {
        return $this->websiteStatusCheckerService;
    }

    public function getServerStatusCheckerService(): ServerStatusCheckerService
    {
        return $this->serverStatusCheckerService;
    }

    public function getSystemCheckerService(): SystemCheckerService
    {
        return $this->systemCheckerService;
    }

    public function getStatuses(): array
    {
        $statuses = [];

        foreach ($this->getConfig() as $groupName => $group) {
            foreach ($group as $type => $t) {
                switch ($type) {
                    case 'web':
                        foreach ($group['web'] as $key => $e) {
                            $statuses[$groupName]['web'][] = [
                                'name' => $e['name'],
                                'endpoint' => $e['url'],
                                'status' => $this->getWebsiteStatusCheckerService()->checkUrl(
                                    $e['url'],
                                    is_null($e['verify']) ? true : $e['verify']
                                )
                            ];
                        }
                        break;
                    case 'server':
                        foreach ($group['server'] as $key => $s) {
                            $statuses[$groupName]['server'][] = [
                                'name' => $s['name'],
                                'service' => $s['service'],
                                'status' => $this->getServerStatusCheckerService()->isServiceAvailable(
                                    $s['pid'],
                                    $s['remote'] ?? null
                                )
                            ];
                        }
                        break;
                }
            }
        }

        return $statuses;
    }
}
