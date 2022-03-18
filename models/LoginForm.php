<?php
/** User:  FHS Dev */

namespace app\models;

/**
 * Class LoginForm
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\models
 */
class LoginForm extends Model
{
    public string $email;
    public string $password;

    public function rules(): array
    { 
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ]; 

    }

    public function attributes(): array
    {
        return ['email', 'password'];
    }

    public function labels(): array
    {
        return [
                'email' => 'E-mail address',
                'password' => 'Password',
            ];
    }

    public function login()
    {
        $user = User::find(['email' => $this->email]);
    }
}