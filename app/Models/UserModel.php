<?php

namespace App\Models;

class UserModel extends Model
{
    public function __construct()
    {
        Model::table('user')
            ->column('id', 'INT', 11)
            ->column('name', 'VARCHAR', 30)
            ->column('sobrenome', 'VARCHAR', 30)
            ->createTableIfNotExists();
    }
}
