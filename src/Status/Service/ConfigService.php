<?php
namespace Status\Service;

class ConfigService
{
    private $configFile;

    public function __construct($configFile)
    {
        $this->configFile = $configFile;
    }

    public function loadConfig()
    {
        $file = file_get_contents($this->configFile);

        return json_decode($file, true);
    }
}
