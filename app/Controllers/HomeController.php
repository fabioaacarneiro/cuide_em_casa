<?php

namespace App\Controllers;

use App\Views\View;

class HomeController
{
    public function index()
    {

        $data = [
            'title' => 'home',
            'message' => 'esta é a página home',
        ];

        return View::render('home', $data);

    }
}
