<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParamsValues extends Migration {
	public function up()
	{
        \Schema::create('filter_params_values', function($table){
            /*** Index ***/
            $table->increments('id');
            $table->unique(['item_id', 'param_id','section']);

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();
            $table->string('value')->nullable();

            /*** Relations ***/
            $table->integer('item_id')->default(0);
            $table->integer('param_id')->default(0);
            $table->string('section')->nullable();

            /*** Statuses ***/
            $table->boolean('status')->dafault(2);
            $table->boolean('privileges')->dafault(0);
            $table->timestamps();
        });
	}


	public function down()
	{
        \Schema::dropIfExists('filter_params_values');
	}
}

