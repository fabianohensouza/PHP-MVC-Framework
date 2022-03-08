<?php
/** User:  FHS Dev */

namespace app\core\form;

use app\models\Model;

/**
 * Class Field
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\core\form
 */
class Field
{
    
    public const TYPE_TEXT = 'text';
    public const TYPE_EMAIL = 'email';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public Model $model;
    public string $attribute;
    public string $type;
    
    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = self::TYPE_TEXT;
    }

    public function __toString()
    {
        return sprintf('
            <div class="mb-3">
                <label>%s</label>
                <input type="%s" name="%s" value="%s" class="form-control %s">
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        ',
            ucfirst($this->attribute),
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );
    }
    
    public function typeField(string $type)
    {
        
        $this->type = defined("self::$type") ? constant("self::$type") : $this->type;
        return $this;
    }
}