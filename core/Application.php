<?php

/**

@author Ary <Aryaristote@email.com>
@package $namespace

*/
namespace App\core;

class Application {

    public static $app = null;

    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;

    public function __construct($rootPath){
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        // $this->response = new Response();
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run(){
        echo $this->router->resolve();
    }
}