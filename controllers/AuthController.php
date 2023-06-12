<?php

namespace App\controllers;

use App\core\Request;
use App\core\Controller;
use App\models\RegisterModel;

class AuthController extends Controller{
    public function login(){
        // Missing class for change layout on Log Pages ------------------
        return $this->render('Login');
    }

    public function register(Request $request){
        // if it post method return the appropriate method
        // Missing class for change layout on Log Pages ------------------
        $RegisterModel = new RegisterModel();

        if($request->isPost()){
            $RegisterModel->loadData($request->getBody());

            if($RegisterModel->validate() && $RegisterModel->register()){
                return "success";
            }

            return $this->render('register', [
                'model' => $RegisterModel
            ]);
        }
        return $this->render('register', [
            'model' => $RegisterModel
        ]);
    }
}

/*
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    exit;
 */
