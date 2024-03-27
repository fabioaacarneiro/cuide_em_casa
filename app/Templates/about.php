<?php

use App\Views\View;

View::inject('header', ['title' => $title]);

View::inject('content', ['message' => $message]);

View::inject('footer');
