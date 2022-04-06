<?php
/** User:  FHS Dev */

namespace app\core\form;

use app\models\Model;

/**
 * Class ContactForm
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\core\form
 */
class ContactForm extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $message = '';

    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'message' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Enter your subject',
            'email' => 'Enter your e-mail address',
            'message' => 'Write your message'
        ];
    }

    public function send()
    {
        return true;
    }
}