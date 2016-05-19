<?php
namespace Status\Service;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ServerStatusCheckerService
{
    public function isServiceAvailble($pid)
    {
        $process = new Process("stat /var/run/{$pid}");
        $process->run();

        if (!$process->isSuccessful()) {
            return false;
        }

        return true;
    }
}
