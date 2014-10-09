<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rent extends Migration {
    public function up()
    {
        /***  ***/
        \Schema::create('section_rent', function($table)
        {
            /*** Index ***/
            $table->increments('id');

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();
            $table->text('intro')->nullable();
            $table->text('text')->nullable();
            $table->string('price')->nullable();

            /*** Relations ***/
            $table->integer('meta_id')->default(0);
            $table->integer('model_id')->default(0);

            /*** Status ***/
            $table->integer('condition')->nullable();
        });
    }

    public function down()
    {
        \Schema::dropIfExists('section_rent');
    }

    public static function fields($Table = 'section_rent'){
        return [
            /*** List ***/
            ['Предложение', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Короткое описание', 'intro', 'text', 'Custom', 'main', true, 'backend', $Table, 'list'],
            ['Цена', 'price', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Обновлено', 'meta-updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'list'],

            /*** Add ***/
            ['Предложение', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Короткое описание', 'intro', 'text', 'Custom', 'main', true, 'backend', $Table, 'add'],
            ['Подробное описание', 'text', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'add'],
            ['Цена', 'price', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', $Table, 'add',''],

            /*** Edit ***/
            // Group :: Main
            ['№', 'id', 'text', 'Title', 'main', false, 'backend', $Table, 'edit'],
            ['Предложение', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
            ['Короткое описание', 'intro', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            ['Подробное описание', 'text', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            ['Цена', 'price', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
            ['Качество', 'condition', 'select', 'Title', 'main', true, 'backend', $Table, 'edit','config','models/Fields.condition'],
            //Group :: Relations
            ['Модель', 'model_id', 'select', 'Title', 'main', true, 'backend', $Table, 'edit', 'model', 'Catalog'],
            ['Пользователь', 'meta-user_id', 'select', 'Title', 'main', true, 'backend', $Table, 'edit', 'model', 'Users'],
            // Group :: Media
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', $Table, 'edit',''],
            ['Галлерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'backend', $Table, 'edit'],

            /*** *** Frontend *** ***/

                /*** List ***/
                // Group :: Main
                ['№', 'id', 'text', 'Title', 'main', false, 'frontend', $Table, 'list'],
                ['Заголовок', 'title', 'text', 'Title', 'main', true, 'frontend', $Table, 'list'],
                ['Введение', 'intro', 'textarea', 'Custom', 'main', true, 'frontend', $Table, 'list'],
                ['Текст', 'text', 'textarea', 'Custom', 'main', true, 'frontend', $Table, 'list'],

                // Group :: Media
                ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'frontend', $Table, 'list',''],
                ['Галлерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'frontend', $Table, 'list'],

                // Group :: Statuses
                ['Цена',        'price',                     'text',       'Price',      'statuses',         true,       'frontend',   $Table,     'list'],


                // Group :: More
                ['Категория',       'catalog-meta-categories',     'link',       'Price',      'more',         true,       'frontend',     $Table,       'list' ,  'link' ,'catalog'],
                ['Пользователь',    'meta-users',     'link',       'Price',      'more',         true,       'frontend',     $Table,       'list' ,  'link' ,'users'],
                ['Состояние',    'condition',     'config',       'Price',      'more',         true,       'frontend',     $Table,       'list' , 'config' , 'condition' ],


        ];
    }
}
