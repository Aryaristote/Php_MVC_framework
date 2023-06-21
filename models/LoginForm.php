<?php 

namespace App\models;

use App\core\Application;
use App\core\Model;

class LoginForm extends Model{
    public string $email = '';
    public string $password = '';
    
    public function rules(): array{
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function label(): array{
        return[
            'email' => 'Your email',
            'password' => 'Your Password',
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

        echo '<pre>';
        var_dump($user);
        echo '</pre>';
        exit;

        return Application::$app->login($user);
    }
}