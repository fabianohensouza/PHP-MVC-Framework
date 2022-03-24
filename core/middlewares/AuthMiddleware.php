<?php
/** User:  FHS Dev */

namespace app\core\middlewares;

use app\core\Application;

/**
 * Class AuthMiddleware
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\core\middlewares
 */
class AuthMiddleware extends BaseMiddleware
{
    public array $actions;
    
    /**
     * AuthMiddleware constructor
     *
     * @param array $actions
     */
    public function __construct(array $actions = []) {
        $this->actions = $actions;
    }

    public function execute()
    {
        if(Application::isGuest()) {
            if(empty($this->actions) || )
        }
    }
}