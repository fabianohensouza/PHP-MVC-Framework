<?php
/** User:  FHS Dev */

namespace app\core;


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
            return $this->renderView('_404');
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }

        return call_user_func($callback, $this->request, $this->response);
    }
    
    public function renderView(String $view, Array $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    
    public function renderContent(String $viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        if(Application::$app->controller) {
            $layout = Application::$app->controller->layout;
        }
        
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/{$layout}.php";
        return ob_get_clean();
    }

    protected function renderOnlyView(String $view, Array $params = [])
    {
        foreach ($params as $key => $value){
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/{$view}.php";
        return ob_get_clean();
    }
}