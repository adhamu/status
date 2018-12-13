<?php
namespace Status\Components;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class CommandRunner
{
    public static function runCommand($command): bool
    {
        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            return false;
        }

        return true;
    }

    public static function runCommandWithOutput($command): string
    {
        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            return $process->getErrorOutput();
        }

        return $process->getOutput();
    }
}
