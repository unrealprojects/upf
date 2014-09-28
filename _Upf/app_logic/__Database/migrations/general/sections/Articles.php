<?php

namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*** Articles ***/

class Articles extends Migration {
	public function up()
	{

        \Schema::create('section_articles', function($table)
        {
            /*** Index ***/
            $table->increments('id');

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();
            $table->string('photos')->nullable();
            $table->string('intro')->nullable();
            $table->text('text')->nullable();

            /*** Relations ***/
            $table->integer('meta_id')->default(0);
        });
	}

	public function down()
	{
        \Schema::dropIfExists('section_articles');
	}

}
