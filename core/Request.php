<?php

namespace App\core;

class Request{
    // Check if the URL contain ? to deal with id 
    public function getPath(){
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if($position === false){
            return $path;
        }
        return substr($path, 0, $position);
    }

    //Get the method pass in URL(Get or Post)
    public function method(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    // check if the method is Get
    public function isGet(){
        return $this->method() === "get";
    }

    // check if the method is Post
    public function isPost(){
        return $this->method() === "post";
    } 

    // Sanitarize the input
    public function getBody(){
        $body = [];
        if($this->method() === 'get'){
            foreach($_GET as $key => $value){
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if($this->method() === 'post'){
            foreach($_POST as $key => $value){
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
}