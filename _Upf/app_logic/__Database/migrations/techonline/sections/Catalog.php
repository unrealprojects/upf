<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Catalog extends Migration {
    public function up()
    {
        /*** Catalog ***/
        \Schema::create('section_catalog', function($table)
        {
            /*** Index ***/
            $table->increments('id');

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();
            $table->string('photos')->nullable();
            $table->text('intro')->nullable();
            $table->text('text')->nullable();


            /*** Relations ***/
            $table->integer('meta_id')->default(0);
        });
    }

    public function down()
    {
        \Schema::dropIfExists('section_catalog');
    }
}