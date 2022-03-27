<?php
/** User:  FHS Dev */

namespace app\core\exception;

use Exception;

/**
 * Class ForbidenException
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\core\exception
 */
class ForbidenException extends Exception
{
    protected $messagem = 'You don\'t have permission to access this page.';
    protected $code = 403;
}