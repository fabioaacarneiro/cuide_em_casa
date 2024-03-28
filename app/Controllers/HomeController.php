<?php

namespace App\Controllers;

use App\Database\DB;
use App\Views\View;

class HomeController
{
    /** método teste, será removido */
    public function index()
    {

        $user = DB::table('user')
            ->find(5);

        $data = [
            'title' => projectName(),
            'message' => 'esta é a página home',
            'user' => $user,
        ];

        return View::render('home', $data);

    }

    /** método teste, será removido */
    public function storeUser()
    {

        $user = DB::table('user')->create([
            'id' => null,
            'nome' => 'Fabio',
            'sobrenome' => 'Carneiro',
            'idade' => 33,
        ])->save();

        $data = [
            'title' => projectName(),
            'message' => 'esta é a página home',
            'user' => $user,
        ];

        return View::render('home', $data);
    }
}
