<?php namespace JDP\Cloud;

use Google\Cloud\Storage\StorageClient;
use Silex\Application;
use Silex\ServiceProviderInterface;

class CloudProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['cloud.storage'] = $app->share(function ($app) {
            return new StorageClient([
                'projectId' => 'jdpedrie-1279',
                'keyFile' => $app['keyFile']
            ]);
        });
    }

    public function boot(Application $app)
    {}
}