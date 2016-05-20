<?php
namespace Status\Components;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class CommandRunner
{
    public static function runCommand($command)
    {
        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            return false;
        }

        return true;
    }

    public static function runCommandWithOutput($command)
    {
        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            return '';
        }

        return $process->getOutput();;
    }
}
