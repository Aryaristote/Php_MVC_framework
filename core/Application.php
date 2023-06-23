<?php

/**

@author Ary <Aryaristote@email.com>
@package $namespace

*/
namespace App\core;

use App\core\view\View;
use App\core\db\DbModel;
use App\core\db\Database;

class Application {

    public static $app = null;

    public string $layout = 'main';
    public string $userClass;
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session; 
    public Database $db; 
    public ? UserModel $user; // ? is in case it's null
    public View $view;

    public ?Controller $controller = null;

    public function __construct($rootPath, array $config){
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        // $this->response = new Response();
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if($primaryValue){
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }else{
            $this->user = null;
        }
    }

    public static function isGuest(){
        return !self::$app->user;
    }

    public function run(){
        try{
            echo $this->router->resolve();
        }catch(\Exception $e){
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e,
            ]);
        }
    }

    public function login(UserModel $user){
        $this->user = $user;
        $primaryKey = $user->primaryKey(); 
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout(){
        $this->user = null;
        $this->session->remove('user');
    }
}