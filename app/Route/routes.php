<?php

use App\Controllers\AboutController;
use App\Controllers\ContactController;
use App\Controllers\Controller;
use App\Controllers\HomeController;

/**
 * all routes of application is declared on this array
 */
return (object) [
    '/' => [ // uri to page view
        'method' => 'GET', // verb http to allowed in this route
        'controller' => HomeController::class, // controller of route
        'action' => 'index', // method of controller thats is maped by route
    ],
    '/about' => [
        'method' => 'GET',
        'controller' => AboutController::class,
        'action' => 'index',
    ],
    '/contact' => [
        'method' => 'GET',
        'controller' => ContactController::class,
        'action' => 'index',
    ],
    '/contact/get' => [
        'method' => 'POST',
        'controller' => ContactController::class,
        'action' => 'getContact',
    ],
    '/404' => [
        'method' => 'GET',
        'controller' => Controller::class,
        'action' => 'getContact',
    ],
];
