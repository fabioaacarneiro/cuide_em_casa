<?php

use App\Views\View;

View::inject('header', ['title' => $title]);

View::inject('content', ['message' => $message]);

d($user);

View::inject('footer');
