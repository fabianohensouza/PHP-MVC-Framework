<?php
/** User:  FHS Dev */

namespace app\models;

use app\core\Application;

/**
 * Class LoginForm
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\models
 */
class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

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
                'email' => 'E-mail',
                'password' => 'Password',
            ];
    }

    public function login()
    {
        $user = User::find(['email' => $this->email]);
        if(!$user) {
            $this->addError('email', 'Incorrect e-mail or password.');
            return false;
        }

        if(!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Incorrect e-mail or password.');
            return false;
        }

        echo '<pre>';
        var_dump($user);
        echo '</pre>';
        exit;
        

        return Application::$app->login($user);
    }
}