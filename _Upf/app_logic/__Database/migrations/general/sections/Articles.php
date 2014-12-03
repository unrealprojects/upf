<?php

namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*** Articles ***/

class Articles extends Migration {
	public function up()
	{

        \Schema::create('section_articles', function($table)
        {
            /*** Index ***/
            $table->increments('id');

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();
            $table->string('intro')->nullable();
            $table->text('text')->nullable();

            /*** Relations ***/
            $table->integer('meta_id')->default(0);
        });
	}

	public function down()
	{
        \Schema::dropIfExists('section_articles');
	}

    public static function fields($Table = 'section_articles'){
        return [
            /*** *** Backend *** ***/

                /*** List ***/
                ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
                ['Введение', 'intro', 'text', 'Custom', 'main', true, 'backend', $Table, 'list'],
                ['Обновлено', 'meta-updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'list'],

                /*** Add ***/
                ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
                ['Введение', 'intro', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'add'],
                ['Текст', 'text', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'add'],
                ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', $Table, 'add',''],

                /*** Edit ***/
                // Group :: Main
                ['№', 'id', 'text', 'Title', 'main', false, 'backend', $Table, 'edit'],
                ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
                ['Введение', 'intro', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'edit'],
                ['Текст', 'text', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'edit'],

                // Group :: Media
                ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', $Table, 'edit',''],
                ['Галерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'backend', $Table, 'edit'],




            /*** *** Frontend *** ***/

                /*** List ***/
                // Group :: Main
                ['№', 'id', 'text', 'Title', 'main', false, 'frontend', $Table, 'list'],
                ['Заголовок', 'title', 'text', 'Title', 'main', true, 'frontend', $Table, 'list'],
                ['Введение', 'intro', 'textarea', 'Custom', 'main', true, 'frontend', $Table, 'list'],
                ['Текст', 'text', 'textarea', 'Custom', 'main', true, 'frontend', $Table, 'list'],

                // Group :: Media
                ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'frontend', $Table, 'list',''],
                ['Галерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'frontend', $Table, 'list'],

                // Group :: Statuses

        ];
    }
}
