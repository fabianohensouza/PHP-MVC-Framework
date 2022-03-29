<?php
/** User:  FHS Dev */

namespace app\core\exception;

use Exception;

/**
 * Class NotFoundException
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\core\exception
 */
class NotFoundException extends Exception
{
    protected $message = 'Page not found.';
    protected $code = 404;
}