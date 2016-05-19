<?php
namespace Status\Service;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ServerStatusCheckerService
{
    public function isServiceAvailble($pidFile)
    {
        $process = new Process("stat {$pidFile}");
        $process->run();

        if (!$process->isSuccessful()) {
            return false;
        }

        return true;
    }
}
