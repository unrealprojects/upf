<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Administrators extends Migration {
	public function up()
	{
        /*** Administrators ***/
        \Schema::create('system_administrators', function($table)
        {
            /*** Index ***/
            $table->increments('id');
            $table->unique('alias');
            $table->string('alias')->nullable();

            /*** Authentication ***/
            $table->string('login')->nullable();
            $table->string('password')->nullable();

            /*** Content ***/
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phones')->nullable();

            /*** Statuses ***/
            $table->boolean('status')->default(\Config::get('models/Fields.status.default'));
            $table->timestamps();
        });
	}

	public function down()
	{
        \Schema::dropIfExists('system_administrators');
	}

}
