<?php
/** User:  FHS Dev */

namespace app\core;

use app\core\Application;
use app\core\middlewares\BaseMiddleware;

/**
 * Class Classname
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\core
 */
class Controller
{
    public string $layout = 'main';
    /**
     * @var app\core\middlewares\BaseMiddleware[]
     */
    public array $middlewares = [];

    public function render(String $view, Array $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout(String $layout)
    {
        $this->layout = $layout;
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}