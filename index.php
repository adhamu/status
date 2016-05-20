<?php
    require __DIR__ . '/vendor/autoload.php';
    $app = (new Status\Container)->get();

    echo $app->getTwigEnvironment()->render(
        'pages/index.html.twig',
        [
            'stylesheet' => $app->getStylesheetFilename(),
            'script' => $app->getScriptFilename(),
            'currentYear' => date("Y"),
            'siteStatuses' => $app->getSiteStatuses(),
            'serviceStatuses' => $app->getServerServiceStatuses(),
            'uptime' => $app->getSystemCheckerService()->getUptime(),
            'machineName' => $app->getSystemCheckerService()->getMachineName(),
            'ip' => $app->getSystemCheckerService()->getIP()
        ]
    );
