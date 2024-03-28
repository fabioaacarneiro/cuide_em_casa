<?php

use App\Views\View;

View::inject('header', ['title' => $title]);

View::inject('content', ['message' => $message]);

echo '<pre>';

d($user);

View::inject('footer');
