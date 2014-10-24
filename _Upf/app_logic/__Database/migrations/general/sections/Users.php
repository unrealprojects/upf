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
            $table->unique('login');
            $table->string('password')->nullable();
            $table->rememberToken();

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();
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

    public static function fields($Table = 'section_users'){
        return [
            /*** List ***/
            ['Логин', 'login', 'text', 'Title', 'main', true, 'backend', 'section_users', 'list'],
            ['Имя', 'first_name', 'text', 'Title', 'main', true, 'backend', 'section_users', 'list'],
            ['Фамилия', 'last_name', 'text', 'Title', 'main', true, 'backend', 'section_users', 'list'],
            ['Обновлено', 'meta-updated_at', 'text', 'Date', 'main', true, 'backend', 'section_users', 'list'],

            /*** Add ***/
            ['Логин', 'login', 'text', 'Title', 'main', true, 'backend', 'section_users', 'add'],
            ['Название', 'title', 'text', 'Title', 'main', true, 'backend', 'section_users', 'add'],
            ['Имя', 'first_name', 'text', 'Title', 'main', true, 'backend', 'section_users', 'add'],
            ['Фамилия', 'last_name', 'text', 'Title', 'main', true, 'backend', 'section_users', 'add'],
            ['Пароль', 'password', 'password', 'Custom', 'main', true, 'backend', 'section_users', 'add'],

            /*** Edit ***/
            // Group :: Main
            ['№', 'id', 'text', 'Title', 'main', false, 'backend', 'section_users', 'edit'],
            ['Логин', 'login', 'text', 'Title', 'main', true, 'backend', 'section_users', 'edit'],
            ['Пароль', 'password', 'password', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],
            ['Название', 'title', 'text', 'Title', 'main', true, 'backend', 'section_users', 'edit'],
            ['Имя', 'first_name', 'text', 'Title', 'main', true, 'backend', 'section_users', 'edit'],
            ['Фамилия', 'last_name', 'text', 'Title', 'main', true, 'backend', 'section_users', 'edit'],

            ['Email', 'email', 'text', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],
            ['Телефоны', 'phones', 'text', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],
            ['Адрес', 'address', 'text', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],
            ['Веб сайт', 'website', 'text', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],
            ['Skype', 'skype', 'text', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],
            ['О пользователе', 'about', 'textarea', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],
//            ['Статус', 'user_status', 'textarea', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],

            // Group :: Media
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', 'section_users', 'edit',''],
            ['Галлерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'backend', 'section_users', 'edit'],



            /*** Frontend :: Edit ***/
            // Group :: Main
            ['Регистрационные данные', 'divider_1', 'divider', 'Title', 'main', true, 'frontend', 'section_users', 'edit'],

            ['Логин', 'login', 'text', 'Title', 'main', true, 'frontend', 'section_users', 'edit'],
            ['Пароль', 'password', 'password', 'Custom', 'main', true, 'frontend', 'section_users', 'edit'],
            ['Название (компании)', 'title', 'text', 'Title', 'main', true, 'frontend', 'section_users', 'edit'],
            ['Имя', 'first_name', 'text', 'Title', 'main', true, 'frontend', 'section_users', 'edit'],
            ['Фамилия', 'last_name', 'text', 'Title', 'main', true, 'frontend', 'section_users', 'edit'],

            ['Контактная информация', 'divider_2', 'divider', 'Title', 'main', true, 'frontend', 'section_users', 'edit'],


            ['О компании', 'about', 'textarea', 'Custom', 'main', true, 'frontend', 'section_users', 'edit'],
            ['Email', 'email', 'text', 'Custom', 'main', true, 'frontend', 'section_users', 'edit'],
            ['Телефоны', 'phones', 'text', 'Custom', 'main', true, 'frontend', 'section_users', 'edit'],
            ['Адрес', 'address', 'text', 'Custom', 'main', true, 'frontend', 'section_users', 'edit'],
            ['Веб сайт', 'website', 'text', 'Custom', 'main', true, 'frontend', 'section_users', 'edit'],
            ['Skype', 'skype', 'text', 'Custom', 'main', true, 'frontend', 'section_users', 'edit'],


            ['Медиа', 'divider_3', 'divider', 'Title', 'main', true, 'frontend', 'section_users', 'edit'],

            // Group :: Media
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'frontend', 'section_users', 'edit',''],
            ['Галлерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'frontend', 'section_users', 'edit']
        ];
    }

}
