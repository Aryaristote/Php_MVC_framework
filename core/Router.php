<?php

namespace App\core;

use App\core\exception\NotFoundException;

class Router {
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response){
        $this->request = $request;
        $this->response = $response;
    }
    
    public function get($path, $callback){
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback){
        $this->routes['post'][$path] = $callback;
    }

    public function resolve(){
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback =  $this->routes[$method][$path] ?? false;

        if($callback === false){
            $this->response->setStatusCode(404);
            // return $this->renderView("404");
            throw new NotFoundException();
        }
        if(is_string($callback)){
            return Application::$app->view->renderView($callback);
        }

        # HACK
        if (is_array($callback)) {
            /** @var \App\core\Controller $controller */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            // return call_user_func([new $callback[0], $callback[1]], $this->request, $this->response);
            // Application::$app->controller->action = $callback[1];
            // $callback[0] = new $callback[0](); 

            foreach($controller->getMiddlewares() as $middleware){
                $middleware->execute();
            }
        }
        return call_user_func($callback, $this->request, $this->response);
    }
    
    protected function renderOnlyView($view, $params){
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}