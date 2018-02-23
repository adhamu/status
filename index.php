<?php
    require __DIR__ . '/vendor/autoload.php';
    $app = (new Status\Container)->get();

    echo $app->getTwigEnvironment()->render(
        'pages/index.html.twig',
        [
            'base' => 'http://' . $_SERVER['HTTP_HOST'] . '/',
            'stylesheet' => $app->getStylesheetFilename(),
            'script' => $app->getScriptFilename(),
            'currentYear' => date("Y"),
            'timestamp' => date("D j M Y H:i:s e"),
            'siteStatuses' => $app->getSiteStatuses(),
            'serviceStatuses' => $app->getServerServiceStatuses(),
            'uptime' => $app->getSystemCheckerService()->getUptime(),
            'machineName' => $app->getSystemCheckerService()->getMachineName(),
            'ip' => $app->getSystemCheckerService()->getIP()
        ]
    );
