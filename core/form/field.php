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
    
    public Model $model;
    public string $attribute;
    
    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return '1';
    }
    
}