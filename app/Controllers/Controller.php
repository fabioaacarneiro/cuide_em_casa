<?php

namespace App\Controllers;

use App\Views\View;

class Controller
{
    private $body;

    private $statusCode = 200;

    public function notFound404()
    {
        return View::render('404');
    }

    public function json($body)
    {
        $this->body = $body;

        return $this;
    }

    public function status($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function build()
    {
        http_response_code($this->statusCode);

        return json_decode($this->body, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
