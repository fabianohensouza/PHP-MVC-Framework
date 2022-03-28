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
    public string $action = '';
    /**
     * @var app\core\middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];

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
    
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}