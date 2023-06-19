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
    public Session $session; 
    public Database $db; 
    // public static Application $app; 

    public function __construct($rootPath, array $config){
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        // $this->response = new Response();
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);
    }

    public function run(){
        echo $this->router->resolve();
    }

    public function __destruct(){
        
    }
}