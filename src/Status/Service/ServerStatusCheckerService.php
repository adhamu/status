<?php
namespace Status\Service;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ServerStatusCheckerService
{
    public function isServiceAvailable($pidFile)
    {
        $process = new Process("stat {$pidFile}");
        $process->run();

        if (!$process->isSuccessful()) {
            return false;
        }

        return true;
    }
}
