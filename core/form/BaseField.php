<?php

namespace App\core\form;
use App\core\Model;

abstract class BaseField{
    abstract public function renderInpput(): string;
    public Model $model;
    public string $attribute;

    /** @param App\core\Model\ $model */
    /** @param string $attribute */

    public function __construct(Model $model, string $attribute){
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString(){
        return sprintf('
            <div class="form-group">
                <label>%s</label>
                %s
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        ',  $this->model->labels()[$this->attribute],
            $this->renderInpput(),
            $this->model->getFirstError($this->attribute),
        );
    }
}