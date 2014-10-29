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
            $table->integer('user_id')->default(0);

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
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Короткое описание', 'intro', 'text', 'Custom', 'main', true, 'backend', $Table, 'list'],
            ['Цена', 'price', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Обновлено', 'meta-updated_at', 'text', 'Date', 'main', false, 'backend', $Table, 'list'],

            /*** Add ***/
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Короткое описание', 'intro', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'add'],
            ['Подробное описание', 'text', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'add'],
            ['Цена', 'price', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Модель', 'model_id', 'select', 'Title', 'main', true, 'backend', $Table, 'add', 'model', 'Catalog'],
            ['Регион', 'meta-region_id', 'select', 'Relation', 'relations', true, 'backend', $Table, 'add','model','Regions'],
            ['Фото техники', 'logotype', 'photo', 'Photo', 'media', true, 'backend', $Table, 'add',''],

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
            ['Пользователь', 'user_id', 'select', 'Title', 'main', true, 'backend', $Table, 'edit', 'model', 'Users'],
            // Group :: Media
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', $Table, 'edit',''],
            ['Галлерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'backend', $Table, 'edit'],





            /*** *** Frontend *** ***/

            /*** Edit ***/
            // Group :: Main
            ['Основная информация', 'divider_1', 'divider', 'Title', 'main', true, 'frontend', $Table, 'edit'],

            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'frontend', $Table, 'edit'],
            ['Короткое описание', 'intro', 'textarea', 'Custom', 'main', true, 'frontend', $Table, 'edit'],
            ['Подробное описание', 'text', 'textarea', 'Custom', 'main', true, 'frontend', $Table, 'edit'],
            ['Цена', 'price', 'text', 'Title', 'main', true, 'frontend', $Table, 'edit'],
            ['Качество', 'condition', 'select', 'Title', 'main', true, 'frontend', $Table, 'edit','config','models/Fields.condition'],

            ['Подробная информация', 'divider_2', 'divider', 'Title', 'main', true, 'frontend', $Table, 'edit'],

            //Group :: Relations
            ['Модель', 'model_id', 'select', 'Title', 'main', true, 'frontend', $Table, 'edit', 'model', 'Catalog'],
            ['Регион', 'meta-region_id', 'select', 'Relation', 'relations', true, 'frontend', $Table, 'edit','model','Regions'],
            ['Тэги', 'meta-tags', 'multi-select', 'Relation', 'relations', true, 'frontend', $Table, 'edit','model','Tags'],


            ['Медиа информация', 'divider_3', 'divider', 'Title', 'main', true, 'frontend', $Table, 'edit'],
            // Group :: Media
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'frontend', $Table, 'edit',''],
            ['Галлерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'frontend', $Table, 'edit'],

        ];
    }
}
