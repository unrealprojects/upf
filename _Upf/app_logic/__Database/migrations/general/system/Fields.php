<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fields extends Migration {

    public function up()
    {
        /*** Fields ***/
        \Schema::create('system_fields', function($table)
        {
            /*** Index ***/
            $table->increments('id');
            $table->unique(['table','destination','relation','view']);

            /*** Content ***/
            $table->string('title');
            $table->string('relation');
            $table->string('type');
            $table->string('class');
            $table->boolean('editable');
            $table->string('group');
            $table->string('values');
            $table->string('values_type');

            /*** Relations ***/
            // Example :: articles, meta...
            $table->string('table')->default('section_meta');
            // Values(frontend, backend)
            $table->string('destination')->default('backend');
            // Values(list, snippet, edit, item, add )
            $table->string('view')->default('list');
        });
    }

    public function down()
    {
        \Schema::dropIfExists('system_fields');
    }

    public static function fields($Table = 'system_fields'){
        return [
            /*** List ***/
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Таблица', 'table', 'text', 'Custom', 'main', false, 'backend', $Table, 'list'],
            ['Отношение', 'relation', 'text', 'Custom', 'main', false, 'backend', $Table, 'list'],
            ['Назначение', 'destination', 'text', 'Custom', 'main', false, 'backend', $Table, 'list'],
            ['Вид', 'view', 'text', 'Custom', 'main', false, 'backend', $Table, 'list'],

            /*** Add ***/
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Таблица', 'table', 'text', 'Custom', 'main', false, 'backend', $Table, 'add'],
            ['Отношение', 'relation', 'text', 'Custom', 'main', false, 'backend', $Table, 'add'],
            ['Назначение', 'destination', 'text', 'Custom', 'main', false, 'backend', $Table, 'add'],
            ['Вид', 'view', 'text', 'Custom', 'main', false, 'backend', $Table, 'add'],

            /*** Edit ***/
            // Group :: Main
            ['№', 'id', 'text', 'Title', 'main', false, 'backend', $Table, 'edit'],
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
            ['Класс', 'class', 'text', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            ['Редактируемый', 'editable', 'text', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            ['Тип', 'type', 'text', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            ['Группа', 'group', 'text', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            ['Значения', 'values', 'text', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            ['Источник занчений', 'values_type', 'text', 'Custom', 'main', true, 'backend', $Table, 'edit'],

            // Group :: Relations
            ['Таблица', 'table', 'text', 'Custom', 'relation', false, 'backend', $Table, 'edit'],
            ['Отношение', 'relation', 'text', 'Custom', 'relation', false, 'backend', $Table, 'edit'],
            ['Назначение', 'destination', 'text', 'Custom', 'relation', false, 'backend', $Table, 'edit'],
            ['Вид', 'view', 'text', 'Custom', 'relation', false, 'backend', $Table, 'edit'],
        ];
    }
}
