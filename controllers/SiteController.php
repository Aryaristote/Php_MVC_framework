<?php 

/**

@author Ary <Aryaristote@email.com>
@package app\controllers

*/

namespace App\core;

use App\core\Controller;


class SiteController extends Controller{
    public function home(){
        $params = [
            'name' => "Ary",
        ];
        return Application::$app->router->renderView('home', $params);
    }
    public function contact(){
        return Application::$app->router->renderView('contact');
    }
    public function handleContact(){
        return "Handling the submit Data";
    }
}