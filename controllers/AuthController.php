<?php
/** User:  FHS Dev */

namespace app\controllers;

use app\models\User;
use app\core\Request;
use app\core\Response;
use app\core\Controller;
use app\core\Application;
use app\models\LoginForm;

/**
 * Class AuthController
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\controllers
 */
class AuthController extends Controller
{
    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();

        if($request->isPost()){
            $loginForm->loadData($request->getBody());

            if($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/');
                exit;
            }
        }

        $this->setLayout('auth');
        return $this->render('login');
    }
    public function register(Request $request)
    {   
        $user = new User();

        if($request->isPost()){
            $user->loadData($request->getBody());

            if($user->validate() && $user->save()) {
                Application::$app->session->setFlahsh('success', 'Thanks for registering.');
                Application::$app->response->redirect('/');
                exit;
            }

            return $this->render('register', [
                'model' => $user
            ]);
        }
        
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $user
        ]);
    }
}