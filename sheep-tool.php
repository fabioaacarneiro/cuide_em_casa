<?php

require_once 'vendor/autoload.php';

use Kint\Kint;

if ($argc < 2) {
    Kint::dump('Uso: php sheep-tool.php <argumento>');
}

$migrationsDir = 'app/Database/migrations/';

$migration = function (string $filename) use ($migrationsDir) {
    if (file_exists($migrationsDir.$filename)) {
        Kint::dump('A migration: '.$filename.' já existe.');
        exit();
    }

    $filepathOutput = $migrationsDir.$filename.'.php';

    $outputMigration = "<?php

namespace App\Database\Migrations;

class $filename
{
    public static function up()
    {

    }

    public static function down()
    {

    }
}";

    if (file_put_contents($filepathOutput, $outputMigration) !== false) {
        Kint::dump('Migration: '.$filename.' criada com sucesso!');
    } else {
        Kint::dump('Migration: '.$filename.' não pode ser criada!');
    }

};

switch ($argv[1]) {
    case 'migration':
        $migration($argv[2]);
        break;

    default:
        // code...
        break;
}
