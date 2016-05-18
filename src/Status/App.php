<?php
namespace Status;

use Dotenv\Dotenv;
use Status\Service\HashedAssetLoadService;
use Twig_Environment;

class App
{
    private $environmentLoader;
    private $assetLoader;
    private $twigEnvironment;

    public function __construct(
        Dotenv $environmentLoader,
        HashedAssetLoadService $assetLoader,
        Twig_Environment $twigEnvironment
    ) {
        $this->environmentLoader = $environmentLoader;
        $this->environmentLoader->load();

        $this->assetLoader = $assetLoader;
        $this->twigEnvironment = $twigEnvironment;
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
}
