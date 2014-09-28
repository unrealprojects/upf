<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParamsToCategories extends Migration {
	public function up()
	{
        \Schema::create('filter_params_to_categories', function($table){
            /*** Index ***/
            $table->increments('id');
            $table->unique(['category_id', 'param_id','section']);

            /*** Relations ***/
            $table->integer('category_id')->nullable();
            $table->integer('param_id')->nullable();
            $table->integer('section')->nullable();
        });
	}

	public function down()
	{
        \Schema::dropIfExists('filter_params_to_categories');
	}
}

