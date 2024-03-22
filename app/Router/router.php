<?php

namespace App\Router;

use App\Controllers\Controller;

/**
 * implements router system for project
 */
$routes = require 'routes.php';

$path = str_replace('/'.projectName(), '', requestUri());

if (requestUri()) {

    if (isset($routes[$path])) {
        $route = $routes[$path];

        if (requestMethod() === $route['method']) {
            $controller = new $route['controller']();
            $action = $route['action'];

            $controller->$action();
        } else {
            exit('<i>Erro na requisição.</i><br>Esperado: <strong>'
              .$route['method'].'</strong><br>Recebido: <strong>'
              .requestMethod().'</strong>');
        }
    } else {
        $controller = new Controller();
        $controller->notFound404();
    }

} else {
    $controller = new Controller();
    $controller->notFound404();
}
