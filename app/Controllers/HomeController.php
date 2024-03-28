<?php

namespace App\Controllers;

use App\Database\DB;
use App\Views\View;

class HomeController
{
    public function index()
    {

        DB::table('user')
            ->primaryKey('id')
            ->string('nome', 20)
            ->string('sobrenome', 20)
            ->int('idade', 3)
            ->createTableIfNotExists();

        // $user = DB::table('user')->create([
        //     'id' => null,
        //     'nome' => 'Fabio',
        //     'sobrenome' => 'Carneiro',
        //     'idade' => 33,
        // ])->save();

        $user = DB::table('user')
            ->find(5);

        $data = [
            'title' => projectName(),
            'message' => 'esta é a página home',
            'user' => $user,
        ];

        return View::render('home', $data);

    }
}
