<?php

include __DIR__ . "/../vendor/autoload.php";

$app = new Silex\Application;
$app['debug'] = true;

$app['keyFile'] = file_get_contents(__DIR__ . '/../../gcp-keyfile.json');

$app->register(new Silex\Provider\ServiceControllerServiceProvider);
$app->register(new JDP\Cloud\CloudProvider);

$app->mount('/storage', new JDP\Cloud\Storage\RouteProvider);
$app->register(new JDP\Cloud\Storage\Provider);

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));

$app->run();