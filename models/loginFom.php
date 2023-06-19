<?php 

namespace App\models; 

use App\core\Model;
use App\core\Application;

class LoginForm extends Model{
    public string $email = '';
    public string $password = '';
    
    public function rules(): array{
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function login(){
        $user = User::findOne(['email' => $this->email]);
        if(!$user){
            $this->addError('email', 'User does not exist with this email');
            return false;
        }
        if(!password_verify($this->password, $user->password)){
            $this->addError('password', 'Password incorrect...');
            return false;
        }

        var_dump("love in air");
        exit;

        return Application::$app->login($user);
    }
}