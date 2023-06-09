<?php

namespace App\controllers;

use App\core\Application;
use App\core\Controller;
use App\core\Request;
use App\core\Response;
use App\models\ContactForm;

class SiteController extends Controller {
    public function home(){
        $params = [
            'name' => "Ary",
        ];
        return $this->render('home', $params);
    }

    public function contact(Request $request, Response $response){
        $contact = new ContactForm();
        if($request->isPost()){
            $contact->loadData($request->getBody());
            if($contact->validate() && $contact->send()){
                Application::$app->session->setFlash('success', 'Thank you for contacting us.');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact,
        ]);
    }
}