<?php

namespace App\Controllers;

use App\Views\View;

class ContactController extends Controller
{
    public function index()
    {

        $data = [
            'title' => projectName(),
            'message' => 'esta é a página contato',
        ];

        return View::render('contact', $data);

    }
}
