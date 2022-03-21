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

    public string $userClass;
    public Router $router;
    public Response $response;
    public Request $request;
    public Controller $controller;
    public Database $db;
    public Session $session;
    public ?DbModel $user;

    public static Application $app;
    public function __construct(string $rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::find([$primaryKey => $primaryValue]);            
        }
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

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryKey);
        return true;

    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');

    }
}
