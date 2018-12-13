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

    public function isServiceAvailable(string $pidFile, string $remote = null): string
    {
        $command = '';

        if (!is_null($remote)) {
            $command .= 'ssh ' . $remote . ' ';
        }
        $command .= 'stat ' . $pidFile . ' > /dev/null';

        return $this->commandRunner->runCommandWithOutput($command);
    }
}
