<?php
/** User:  FHS Dev */

namespace app\core;


/**
 * Class Session
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\core
 */
class Session
{

    protected const FLASH_KEY = 'flash_messages';

    /**
     * Router construct
     *
     *Starts the PHP session resource 
     */
    public function __construct() {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ($flashMessages as $key => &$flashMessage) {
            $flashMessage['remove'] = true;
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;

echo '<pre>';
var_dump($_SESSION[self::FLASH_KEY]);
echo '</pre>';
    }

    public function setFlahsh($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'value' => $message,
            'remove' => false
        ];
    }


    public function getFlahsh($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'];
    }

    public function __destruct()
    {
        
    }
}