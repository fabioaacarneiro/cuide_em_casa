<?php

namespace App\Route;

use App\Controllers\Controller;

/**
 * implements router system for project
 */
class Router
{
    /**
     * start analysing requests on url for router system
     *
     * @param  string  $path  request url on browser
     */
    public static function dispatcher(string $path)
    {

        $routes = require 'routes.php';

        $route = $routes->$path;

        if (! $route['action']) {

            $controller = new Controller();
            $controller->notFound404();
        }

        if (requestMethod() !== $route['method']) {
            exit('<i>Erro na requisição.</i><br>Esperado: <strong>'
              .$route['method'].'</strong><br>Recebido: <strong>'
              .requestMethod().'</strong>');
        }

        $controller = new $route['controller']();
        $action = $route['action'];
        $controller->$action();
    }
}
