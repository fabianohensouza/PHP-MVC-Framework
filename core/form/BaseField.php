<?php
/** User:  FHS Dev */

namespace app\core\form;

use app\models\Model;

/**
 * Class BaseField
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\core\form
 */
abstract class BaseField
{

    public Model $model;
    public string $attribute;
    
    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }
    abstract public function renderInput(): string;

    public function __toString()
    {
        return sprintf('
            <div class="mb-3">
                <label>%s</label>
                %s
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        ',
            $this->model->labels()[$this->attribute] ?? ucfirst($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}