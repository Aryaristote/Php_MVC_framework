<?php 

namespace App\core\form;

class TextareaField extends BaseField{
    
    public function renderInpput(): string{
        return sprintf('<textarea name="%s" class="form-control%s">%s</textarea>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->{$this->attribute},  
        );
    }
}   