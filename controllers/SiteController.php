<?php

namespace App\controllers;

use App\core\Application;

class SiteController extends Controller {
    public function home(){
        $params = [
            'name' => "Ary",
        ];
        return Application::$app->router->renderView('home', $params);
    }

    public function contact(){
        return Application::$app->router->renderView('contact');
    }

    public function handleContact()
    {
        return "Handling the";
    }
}