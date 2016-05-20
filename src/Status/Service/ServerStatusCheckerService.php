<?php
namespace Status\Service;

use Status\Components\CommandRunner;

class ServerStatusCheckerService
{
    private $commandRunner;

    public function __construct(CommandRunner $commandRunner)
    {
        $this->commandRunner = $commandRunner;
    }

    public function isServiceAvailable($pidFile)
    {
        return $this->commandRunner->runCommand("stat {$pidFile}");
    }
}
