<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Voted extends Migration {
	public function up()
	{
        /*** Voted ***/
        \Schema::create('system_voted', function($table)
        {
            /*** Index ***/
            $table->increments('id');
            $table->unique('item_id','section');

            /*** Content ***/
            $table->string('ip')->nullable();

            /*** Relations ***/
            $table->integer('section')->nullable();
            $table->integer('item_id')->nullable();
        });
	}

	public function down()
	{
        \Schema::dropIfExists('system_voted');
	}

}
