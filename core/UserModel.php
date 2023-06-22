<?php

namespace App\core;

use App\core\DbModel; 

abstract class UserModel extends DbModel{
    abstract public function getDisplayName(): string;
}