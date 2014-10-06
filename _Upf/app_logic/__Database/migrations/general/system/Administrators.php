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

    /*** Insert Default System Functionality ***/
    public static function AdministratorsFields($Table = 'system_administrators'){
        return [
            /*** List ***/
            ['Логин', 'login', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['email', 'email', 'text', 'Custom', 'main', false, 'backend', $Table, 'list'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'list'],

            /*** Add ***/
            ['Логин', 'login', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['email', 'email', 'text', 'Custom', 'main', false, 'backend', $Table, 'add'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'add'],

            /*** Edit ***/
            // Group :: Main
            ['№', 'id', 'text', 'Title', 'main', false, 'backend', $Table, 'edit'],
            ['Логин', 'login', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
            ['email', 'email', 'text', 'Custom', 'main', false, 'backend', $Table, 'edit'],
            ['Созданно', 'created_at', 'text', 'Date', 'main', true, 'backend', $Table, 'edit'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'edit']
        ];
    }
}
