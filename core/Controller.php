<?php 


namespace App\core;

class Controller{
    
    // Missing class for change layout on Log Pages ------------------

    public function render($view, $params = []){
        return Application::$app->router->renderView($view, $params);
    }
}