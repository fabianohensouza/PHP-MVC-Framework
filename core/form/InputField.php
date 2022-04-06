<?php
/** User:  FHS Dev */

namespace app\core\form;

use app\models\Model;

/**
 * Class InputField
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\core\form
 */
class InputField extends BaseField
{
    
    public const TYPE_TEXT = 'text';
    public const TYPE_EMAIL = 'email';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public string $type;
    
    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }
    
    public function typeField(string $type)
    {
        
        $this->type = defined("self::$type") ? constant("self::$type") : $this->type;
        return $this;
    }

    public function renderInput(): string 
    {
        return sprintf('<input type="%s" name="%s" value="%s" class="form-control %s">', 
                        $this->type,
                        $this->attribute,
                        $this->model->{$this->attribute},
                        $this->model->hasError($this->attribute) ? ' is-invalid' : ''
                    );
    }
}