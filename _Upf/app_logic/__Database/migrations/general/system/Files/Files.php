<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Files extends Migration {
    public function up()
    {
        /*** Voted ***/
        \Schema::create('system_files', function($table)
        {
            /*** Index ***/
            $table->increments('id');

            /*** Content ***/
            $table->string('src')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('file_type')->nullable();
        });
    }

    public function down()
    {
        \Schema::dropIfExists('system_files');
    }

}
