<?php
/** User:  FHS Dev */

namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\core\Controller;
use app\models\User;

/**
 * Class AuthController
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\controllers
 */
class AuthController extends Controller
{
    public function login(Request $request)
    {
        if($request->isPost()){
            return 'Handle submitted data!';
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
                
                Application::$app->response->redirect('/');
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