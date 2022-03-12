<?php
/** User:  FHS Dev */

namespace app\models;

/**
 * Class Model
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\models
 */
abstract class Model
{

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';    

    public array $errors = [];

    public function loadData(array $data)
    {

        foreach ($data as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->{$attribute} = $value;
            }
        }

    }

    abstract public function rules(): array;

    public function validate()
    {        
        foreach ($this->rules() as $attribute => $rules) {

            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }
                
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }

            }

        }

        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule, array $params = [])
    {        
        $message = $this->errorMessagem()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessagem(): array
    {        
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be a valid email address',
            self::RULE_MIN => 'This field must have a minimun of {min} digits',
            self::RULE_MAX => 'This field must have a maximum of {max} digits',
            self::RULE_MATCH => 'This field must be the same as {match}'
        ];
    }

    public function hasError(string $attribute)
    {        
        return $this->errors[$attribute] ?? FALSE;
    }

    public function getFirstError(string $attribute)
    {        
        return $this->errors[$attribute][0] ?? FALSE;
    }

}