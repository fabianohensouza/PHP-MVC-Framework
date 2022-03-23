<?php
/** User:  FHS Dev */

namespace app\core;

use app\core\Application;

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
     * @var 
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

    public function registerMiddleware(AuthMiddleware $middleware)
    {
        # code...
    }
}