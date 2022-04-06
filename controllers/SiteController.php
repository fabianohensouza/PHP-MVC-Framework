<?php
/** User:  FHS Dev */

namespace app\controllers;

use app\core\Request;
use app\core\Controller;
use app\core\Application;
use app\core\form\ContactForm;
use app\core\Response;

/**
 * Class SiteController
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\controllers
 */
class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => 'FHS Dev'
        ];
        return $this->render('home', $params);
    }

    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if($request->isPost()) {
            $contact->loadData($request->getBody());
            
            if($contact->validate() && $contact->send()) {
                Application::$app->session->setFlahsh('success', 'Thanks to contacting us!');
                return $response->redirect('/contact');
            } 
        }
        return $this->render('contact', [
                                            'model' => $contact
                                        ]);
    }
}