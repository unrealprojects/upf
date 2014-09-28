<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration {
    public function up()
    {
        /*** Users ***/
        \Schema::create('section_users', function($table)
        {
            /*** Index ***/
            $table->increments('id');

            /*** Authentication ***/
            $table->string('login')->nullable();
            $table->string('password')->nullable();

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();
            $table->string('photos')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->boolean('gender')->default(0);
            $table->date('birthday')->nullable();

            $table->string('user_status')->nullable();

            $table->string('email')->nullable();
            $table->string('phones')->nullable();
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->string('skype')->nullable();
            $table->string('about')->nullable();

            /*** Relations ***/
            $table->integer('meta_id')->default(0);
        });
    }

    public function down()
    {
        \Schema::dropIfExists('section_users');
    }

}
