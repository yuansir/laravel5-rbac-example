<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Filesystem\Filesystem;

class ImportData extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fileSystem = new Filesystem();
        $database = $fileSystem->get(base_path('database') . '/' . 'database.sql');
        DB::connection()->getPdo()->exec($database);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $query = DB::connection()->getPdo()->query("show tables");
        foreach ($query->fetchAll() as $table) {
            if ($table[0] == 'migrations') {
                continue;
            }
            DB::connection()->getPdo()->exec("DROP TABLE IF EXISTS  `{$table[0]}`");
        }
        DB::connection()->getPdo()->exec("DELETE FROM `migrations` WHERE `migration` <> '2015_04_07_115208_import_data'");
    }

}
