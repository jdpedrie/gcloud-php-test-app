<?php namespace JDP\Cloud\Storage;

use Google\Cloud\Exception\GoogleException;
use Google\Cloud\Storage\StorageClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;

class Controller
{
    const BUCKET_NAME = 'test-app';

    private $template;
    private $storage;

    public function __construct(
        Twig_Environment $template,
        StorageClient $storage
    ) {
        $this->template = $template;
        $this->storage = $storage;
    }

    public function upload()
    {
        return new Response($this->template->render('storage/upload.twig'));
    }

    public function doUpload(Request $request)
    {
        $file = $request->files->get('file');

        try {
            $bucket = $this->storage->bucket(self::BUCKET_NAME);
            $res = $bucket->upload(file_get_contents($file->getRealPath()), [
                'name' => $file->getClientOriginalName()
            ]);

            print_R($res);exit;
        } catch(GoogleException $e) {
            return "An Error Occurred: ". $e->getMessage();
        }
    }
}