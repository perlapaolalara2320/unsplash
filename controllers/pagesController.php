<?php

namespace Controllers;

use MVC\Router;


class PagesController
{
    public static function index(Router $router)
    {
        session_start();
        $router->render('pages/index', [
            'titulo' => "Beautiful pictures",
        ]);
    }
}
