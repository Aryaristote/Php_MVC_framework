<?php

namespace App\controllers;

use App\models\User;
use App\core\Request;
use App\core\Response;
use App\core\Controller;
use App\core\Application;
use App\models\LoginForm;
use App\core\middlewares\AuthMiddleware;

class AuthController extends Controller{
    public function __construct(){
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response){
        $loginForm = new LoginForm();
        if($request -> isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                $response->redirect('/');
                return;
            }
        }
        // $this->setLayout('auth') Missing class for change layout on Log Pages ------------------
        return $this->render('login', [
            'model' => $loginForm,
        ]);
    }

    public function register(Request $request){
        // if it post method return the appropriate method
        // Missing class for change layout on Log Pages ------------------
        $user = new User();

        if($request->isPost()){
            $user->loadData($request->getBody());

            if($user->validate() && $user->save()){
                Application::$app->session->setFlash('success', 
                'Thanks for registering');
                Application::$app->response->redirect('/');
                exit;
            }

            return $this->render('register', [
                'model' => $user
            ]);
        }
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request ,Response $response){
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile(){
        return $this->render('profile');
    }
}

/*
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    exit;
 */
