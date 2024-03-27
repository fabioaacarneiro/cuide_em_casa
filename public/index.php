<?php

/**
 * starter point of application
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Route\Router;
use Tracy\Debugger;

require_once '../vendor/autoload.php';
require_once '../app/Route/Router.php';

Debugger::enable();

Router::dispatcher(requestUrl());
