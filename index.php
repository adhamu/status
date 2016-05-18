<?php
    require __DIR__ . '/vendor/autoload.php';
    $app = (new Status\Container)->get();

    echo $app->getTwigEnvironment()->render(
        'layouts/base.html.twig',
        [
            'the' => 'variables',
            'go' => 'here'
        ]
    );
