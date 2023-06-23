<?php 

namespace App\models;

use App\core\Model;

class ContactForm extends Model {
    public string $subject = '';
    public string $email = '';
    public string $body = '';

    public function rules(): array{
         return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED],
         ];
    }

    public function labels(): array{
        return[
            'subject' => 'Enter your subject',
            'email' => 'Provide your Email',
            'body' => 'Enter you message content',
        ];
    }

    public function send(){
        return "Love in air";
    }
}