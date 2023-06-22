<?php 


namespace App\core;

class Controller{
    public string $layout = 'main';

    /**
     * @var \App\core\middlewares\BaseMiddleware
     */
    public array $middlewares = [];

    public function setLayout($layout){
        $this->layout = $layout;
    }

    public function render($view, $params = []){
        return Application::$app->router->renderView($view, $params);
    }

    public function registerMiddleware(){
        return null;
    }
}