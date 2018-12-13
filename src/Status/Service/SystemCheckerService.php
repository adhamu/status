<?php
namespace Status\Service;

use Status\Components\CommandRunner;

class SystemCheckerService
{
    private $commandRunner;

    public function __construct(CommandRunner $commandRunner)
    {
        $this->commandRunner = $commandRunner;
    }

    public function getUptime(): string
    {
        return $this->commandRunner->runCommandWithOutput('uptime');
    }

    public function getMachineName(): string
    {
        return $this->commandRunner->runCommandWithOutput('hostname -s');
    }

    public function getIP(): string
    {
        return $this->commandRunner->runCommandWithOutput('ipconfig getifaddr en0');
    }
}
