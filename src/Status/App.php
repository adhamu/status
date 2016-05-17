<?php
namespace Status;

use josegonzalez\Dotenv\Loader;
use Status\Services\HashedAssetLoadService;

class App
{
    private $environmentLoader;
    private $assetLoader;

    public function __construct(Loader $environmentLoader, HashedAssetLoadService $assetLoader)
    {
        $this->environmentLoader = $environmentLoader;
        $this->environmentLoader->parse();
        $this->environmentLoader->toEnv();

        $this->assetLoader = $assetLoader;
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
}
