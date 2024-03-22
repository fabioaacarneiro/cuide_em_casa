<?php

namespace App\Router;

use App\Controllers\Controller;

/**
 * implements router system for project
 */
$routes = require 'routes.php';

$path = str_replace('/'.projectName(), '', requestUri());

if (! requestUri() || ! isset($routes[$path])) {

    $controller = new Controller();
    $controller->notFound404();
}

$route = $routes[$path];

if (requestMethod() !== $route['method']) {
    exit('<i>Erro na requisição.</i><br>Esperado: <strong>'
      .$route['method'].'</strong><br>Recebido: <strong>'
      .requestMethod().'</strong>');
}

$controller = new $route['controller']();
$action = $route['action'];
$controller->$action();
