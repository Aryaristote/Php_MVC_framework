<?php 

namespace App\core;

abstract class Model {
    public const RULE_REQUIRED = "required";
    public const RULE_EMAIL = "email";
    public const RULE_MIN = "min";
    public const RULE_MAX = "max";
    public const RULE_MATCH = "match";
    public const RULE_UNIQUE = "unique";

    public function loadData($data){
        foreach($data as $key => $value){
            if(property_exists($this, $key)){
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;
    public array $errors = [];

    public function labels(): array{
        return [];
    }

    public function getLabel($attributes){
        return $this->labels()[$attributes] ?? $attributes;
    }

    public function validate(){
        //Looping through all roles
        foreach($this->rules() as $attributes => $rules){
            $value = $this->{$attributes};
            //Looping through each input rules
            foreach($rules as $rule){
                $rulesname = $rule;
                if(is_array($rulesname)){
                    $rulesname = $rule[0];
                }
                if($rulesname === self::RULE_REQUIRED && !$value){
                    $this->addErrorForRule($attributes, self::RULE_REQUIRED);
                }
                if($rulesname === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
                    $this->addErrorForRule($attributes, self::RULE_EMAIL);
                }
                if($rulesname === self::RULE_MIN && strlen($value) < $rule['min']){
                    $this->addErrorForRule($attributes, self::RULE_MIN, $rule);
                }
                if($rulesname === self::RULE_MAX && strlen($value) > $rule['max']){
                    $this->addErrorForRule($attributes, self::RULE_MAX, $rule);
                }
                if($rulesname === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $rule['match'] = $this->getLabel($rule['match']);
                    $this->addErrorForRule($attributes, self::RULE_MATCH, $rule);
                }
                if($rulesname === self::RULE_UNIQUE){
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attributes;
                    $tableName = $className::tableName();
                    $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :attr");
                    $statement->bindValue(":attr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if($record){
                        $this->addErrorForRule($attributes, self::RULE_UNIQUE, ['field' => $this->getLabel($attributes)]);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    private function addErrorForRule(string $attributes, string $rule, $params = []){
        $message = $this->errorMessages()[$rule] ?? '';
        foreach($params as $key => $value){
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attributes][] = $message;
    }

    public function addError(string $attribute, string $message){
        $this->errors[$attribute][] = $message;
    }


    public function errorMessages(){
        return [
            self::RULE_REQUIRED => "This field is required",
            self::RULE_EMAIL => "This field must be a valid email format",
            self::RULE_MIN => "Min length of the field must be {min}",
            self::RULE_MAX => "Max length of the field must be {max}",
            self::RULE_MATCH => "This field must be the same as {match}",
            self::RULE_UNIQUE => "Records with this {field} already exist",
        ];
    }

    public function hasError($attribute){              
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute){
        return $this->errors[$attribute][0] ?? false;
    }
}