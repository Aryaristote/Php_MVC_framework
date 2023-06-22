<?php

namespace App\core\exception;

class ForbiddenException extends \Exception{
    protected $message = "Do not have permission to access this page";
    protected $code = 403;
}