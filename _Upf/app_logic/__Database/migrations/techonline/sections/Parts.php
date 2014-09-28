<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Parts extends Migration {
    public function up()
    {
        /***  ***/
        \Schema::create('section_parts', function($table)
        {
            /*** Index ***/
            $table->increments('id');

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();
            $table->string('price')->nullable();
            $table->text('intro')->nullable();
            $table->text('text')->nullable();
            $table->string('photos')->nullable();

            /*** Relations ***/
            $table->integer('meta_id')->default(0);

            /*** Status ***/
            $table->integer('opacity')->nullable();
        });
    }

    public function down()
    {
        \Schema::dropIfExists('section_parts');
    }
}