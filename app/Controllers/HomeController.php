<?php

namespace App\Controllers;

use App\Database\DB;
use App\Views\View;

class HomeController
{
    public function index()
    {

        $userTable = DB::table('user')
            ->column('id', 'INT', 11)
            ->column('nome', 'VARCHAR', 20)
            ->column('sobrenome', 'VARCHAR', 20)
            ->column('idade', 'INT', 3)
            ->createTableIfNotExists();

        $data = [
            'title' => 'home',
            'message' => 'esta é a página home',
            'table' => $userTable,
        ];

        return View::render('home', $data);

    }
}
