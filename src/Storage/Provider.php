<?php namespace JDP\Cloud\Storage;

use Silex\ServiceProviderInterface;
use Silex\Application;

class Provider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['storage.controller'] = $app->share(function ($app) {
            return new Controller(
                $app['twig'],
                $app['cloud.storage']
            );
        });
    }

    public function boot(Application $app)
    {}
}