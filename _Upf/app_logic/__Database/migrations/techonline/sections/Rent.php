<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rent extends Migration {
    public function up()
    {
        /***  ***/
        \Schema::create('section_rent', function($table)
        {
            /*** Index ***/
            $table->increments('id');

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();
            $table->string('photos')->nullable();
            $table->text('intro')->nullable();
            $table->text('text')->nullable();
            $table->string('price')->nullable();

            /*** Relations ***/
            $table->integer('meta_id')->default(0);
            $table->integer('model_id')->default(0);

            /*** Status ***/
            $table->integer('is_free')->nullable();
            $table->integer('opacity')->nullable();
        });
    }

    public function down()
    {
        \Schema::dropIfExists('section_rent');
    }
}
