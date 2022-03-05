<?php
/** User:  FHS Dev */

namespace app\controllers;

use app\core\Request;
use app\core\Controller;
use app\core\Application;

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

    public function contact()
    {
        return $this->render('contact');
    }

    public function handleContact(Request $request)
    {
        echo '<pre>';
        var_dump($request->getBody());
        echo '</pre>';
        exit;
        return 'Handling post data!';
    }
}