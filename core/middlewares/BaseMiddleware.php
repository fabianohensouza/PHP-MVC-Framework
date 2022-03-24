<?php
/** User:  FHS Dev */

namespace app\core\middlewares;

/**
 * Class BaseMiddleware
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\core\middlewares
 */
abstract class BaseMiddleware
{
    abstract public function execute();
}