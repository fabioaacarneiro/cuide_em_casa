<?php

/**
 * starter point of application
 */

use Tracy\Debugger;

require_once '../vendor/autoload.php';
require_once '../app/Router/router.php';

Debugger::enable();
