<?php namespace JDP\Cloud\Storage;

use Silex\Application;
use Silex\ControllerProviderInterface;

class RouteProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $c = $app['controllers_factory'];

        $c->get('/upload', 'storage.controller:upload');

        $c->post('/upload', 'storage.controller:doUpload');

        return $c;
    }
}