<?php

use App\Database\DB;

class UserTable
{
    public static function up()
    {
        DB::table('user')
            ->int('id', 11)
            ->string('name', 20)
            ->string('sobrenome', 20)
            ->string('telefone', 11)
            ->boolean('is_active')
            ->createTableIfNotExists();
    }

    public static function down()
    {
        DB::table('user')
            ->dropTableIfExists();
    }
}
