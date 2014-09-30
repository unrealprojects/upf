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

            /*** Authentication ***/
            $table->string('login');
            $table->unique('login');
            $table->string('password');
            $table->rememberToken();


            /*** Content ***/
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
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
