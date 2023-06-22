<?php 

namespace App\core\middlewares;

use App\core\Application;
use App\core\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware {
    public array $actions = [];

    public function __construct(array $actions = []){
        $this->actions = $actions;
    }

    public function execute(){
        // try {
        //     if (Application::isGuest()) {
        //         if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
        //             throw new ForbiddenException();
        //         }
        //     }
        // } catch (ForbiddenException $e) {
        //     // echo "Access Forbidden: " . $e->getMessage(); https://wiiqare.com/
        // }

        if(Application::isGuest()){
            if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)){
                throw new ForbiddenException();
            }
        }
    }
}