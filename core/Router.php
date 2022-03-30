<?php
/** User:  FHS Dev */

namespace app\core;

use app\core\exception\NotFoundException;

/**
 * Class Router
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\core
 */
class Router
{

    protected array $routes = [];
    public Request $request;
    public Response $response;

    /**
     * Router construct
     *
     * @param app\core\Request $request
     * @param app\core\Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $method = $this->request->method();
        $path = $this->request->getPath();
        $callback = $this->routes[$method][$path] ?? FALSE;

        if ($callback === FALSE) {
            $this->response->setStatusCode(404);
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }

        if (is_array($callback)) {
            /** @var $controller \app\core\Controller */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }

        }

        return call_user_func($callback, $this->request, $this->response);
    }
}