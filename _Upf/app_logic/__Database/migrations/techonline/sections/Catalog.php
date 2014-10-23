<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Catalog extends Migration {
    public function up()
    {
        /*** Catalog ***/
        \Schema::create('section_catalog', function($table)
        {
            /*** Index ***/
            $table->increments('id');

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();
            $table->text('intro')->nullable();
            $table->text('text')->nullable();

            /*** Relations ***/
            $table->integer('meta_id')->default(0);
        });
    }

    public function down()
    {
        \Schema::dropIfExists('section_catalog');
    }

    public static function fields($Table = 'section_catalog'){
        return [
            /*** List ***/
            ['Модель', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Короткое описание', 'intro', 'text', 'Custom', 'main', true, 'backend', $Table, 'list'],
            ['Обновлено', 'meta-updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'list'],

            /*** Add ***/
            ['Модель', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Короткое описание', 'intro', 'text', 'Custom', 'main', true, 'backend', $Table, 'add'],
            ['Подробное описание', 'text', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'add'],
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', $Table, 'add',''],

            /*** Edit ***/
            // Group :: Main
            ['№', 'id', 'text', 'Title', 'main', false, 'backend', $Table, 'edit'],
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
            ['Короткое описание', 'intro', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            ['Подробное описание', 'text', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            ['Параметры', 'meta-categories-params', 'params', 'Relation', 'relations', true, 'backend', $Table, 'edit'],

            // Group :: Media
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', $Table, 'edit',''],
            ['Галлерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'backend', $Table, 'edit'],
        ];
    }
}