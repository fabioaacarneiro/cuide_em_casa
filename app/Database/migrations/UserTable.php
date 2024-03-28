<?php

use App\Database\DB;

class UserTable
{
    public static function up()
    {
        DB::table('user')
            ->primaryKey('id')
            ->string('nome', 20, false)
            ->string('sobrenome', 20)
            ->int('idade', 3)
            ->createTableIfNotExists();

    }

    public static function down()
    {
        DB::table('user')
            ->dropTableIfExists();
    }
}
