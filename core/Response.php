<?php
/** User:  FHS Dev */

namespace app\core;

/**
 * Class Classname
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package ${NAMESPACE}
 */
class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}