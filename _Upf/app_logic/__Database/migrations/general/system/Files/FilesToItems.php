<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FilesToItems extends Migration {
    public function up()
    {
        \Schema::create('system_files_to_items', function($table){
            /*** Index ***/
            $table->increments('id');
            $table->unique(['item_id', 'file_id','section']);

            /*** Relations ***/
            $table->integer('item_id')->nullable();
            $table->integer('file_id')->nullable();
            $table->integer('section')->nullable();
        });
    }

    public function down()
    {
        \Schema::dropIfExists('system_files_to_items');
    }
}

