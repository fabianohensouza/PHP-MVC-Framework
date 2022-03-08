<?php
/** User:  FHS Dev */

namespace app\core;

use app\core\Controller;

/**
 * Class Application
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\core
 */
class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    public Response $response;
    public Request $request;
    public Controller $controller;
    public Database $db;
    public static Application $app;
    public function __construct(string $rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    /**
     * Get the value of controller
     */ 
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the value of controller
     *
     * @return  app\core\Controller
     */ 
    public function setController($controller)
    {
        $this->controller = $controller;
    }
}