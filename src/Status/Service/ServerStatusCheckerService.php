<?php
namespace Status\Service;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ServerStatusCheckerService
{
    private $process;

    public function __construct(Process $process)
    {
        $this->process = $process;
    }

    public function checkService($command)
    {
        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            return 'Unavailable';
        }

        return "OK";
    }
}
