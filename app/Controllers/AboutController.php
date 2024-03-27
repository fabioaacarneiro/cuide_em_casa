<?php

namespace App\Controllers;

use App\Views\View;

class AboutController
{
    public function index()
    {

        $data = [
            'title' => 'sobre',
            'message' => 'esta é a página sobre',
        ];

        return View::render('about', $data);

    }
}
