<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Params extends Migration {
	public function up()
	{
        \Schema::create('filter_params', function($table){
            /*** Index ***/
            $table->increments('id');
            $table->unique('alias');
            $table->string('alias')->nullable();

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();
            $table->string('dimension')->nullable();

            /*** Settings ***/
            $table->string('param_type')->nullable();
            $table->string('param_set')->nullable();

            /*** Relations ***/
            $table->string('section')->nullable();

            /*** Statuses ***/
            $table->boolean('status')->dafault(2);
            $table->boolean('privileges')->dafault(0);
            $table->timestamps();
        });
	}

	public function down()
	{
        \Schema::dropIfExists('filter_params');
	}
}

