<?php
namespace Status;

use josegonzalez\Dotenv\Loader;
use Status\Service\HashedAssetLoadService;
use Twig_Environment;

class App
{
    private $environmentLoader;
    private $assetLoader;
    private $twigEnvironment;

    public function __construct(
        Loader $environmentLoader,
        HashedAssetLoadService $assetLoader,
        Twig_Environment $twigEnvironment
    ) {
        $this->environmentLoader = $environmentLoader;
        $this->environmentLoader->parse();
        $this->environmentLoader->toEnv();

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
