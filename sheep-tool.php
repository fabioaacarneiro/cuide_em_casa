<?php

require_once 'vendor/autoload.php';

use Kint\Kint;

if ($argc < 2) {
    Kint::dump('Uso: php sheep-tool.php <argumento>');
}

$migrationsDir = 'app/Database/migrations/';

/**
 * @param  string  $filename  filename of the migration
 *
 * @use string $migrationsDir local var with the migrations location
 */
$migration = function (string $filename) use ($migrationsDir) {
    if (file_exists($migrationsDir . $filename . '.php')) {
        d('A migration: ' . $filename . ' já existe.');
        exit();
    }

    $filepathOutput = $migrationsDir . $filename . '.php';

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
        Kint::dump('Migration: ' . $filename . ' criada com sucesso!');
    } else {
        Kint::dump('Migration: ' . $filename . ' não pode ser criada!');
    }
};

/**
 * run all migrations on Database
 */
$migrate = function (string $migrateOrRollback = 'migrate') use ($migrationsDir) {

    $files = scandir($migrationsDir);
    $files = array_diff($files, ['.', '..']);

    foreach ($files as $file) {
        $pathFile = $migrationsDir . $file;
        if (is_file($pathFile) && pathinfo($pathFile, PATHINFO_EXTENSION) === 'php') {

            require_once $pathFile;

            $className = pathinfo($pathFile, PATHINFO_FILENAME);
            if ($migrateOrRollback === 'migrate') {
                try {
                    $className::up();
                    d("Migration: $className executou com sucesso!");
                } catch (Exception $e) {
                    d("Migration: $className falhou!\nErro: " . $e->getMessage());
                }
            } else {
                try {
                    $className::down();
                    d("Rollback: $className executou com sucesso!");
                } catch (Exception $e) {
                    d("Rollback: $className falhou!\nErro: " . $e->getMessage());
                }
            }
        } else {
            echo "O arquivo '$file' não é um arquivo PHP válido ou não foi encontrado.";
        }
    }
};

switch ($argv[1]) {
    case 'migration':
        $migration($argv[2]);
        break;

    case 'migrate':
        $migrate();
        break;

    case 'migrate:rollback':
        $migrate('rollback');
        break;

    default:
        d('argumento inválido');
        break;
}
