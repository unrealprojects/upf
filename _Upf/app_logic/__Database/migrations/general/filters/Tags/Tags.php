<?php

namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*** Tags ***/

class Tags extends Migration {
	public function up()
	{
        \Schema::create('filter_tags', function($table)
        {
            /*** Index ***/
            $table->increments('id');
            $table->unique('alias');
            $table->string('alias')->nullable();

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();

            /*** Relations***/
            $table->string('section')->nullable();

            /*** Statuses ***/
            $table->boolean('status')->dafault(\Config::get('models/Fields.status.default'));
            $table->boolean('privileges')->dafault(\Config::get('models/Fields.privileges.default'));
            $table->timestamps();
        });
	}

	public function down()
	{
        \Schema::dropIfExists('filter_tags');
	}

    public static function fields($Table = 'filter_tags'){
        return [
            /*** List ***/
            ['Тег', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Алиас', 'alias', 'text', 'Custom', 'main', false, 'backend', $Table, 'list'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'list'],

            /*** Add ***/
            ['Тег', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Алиас', 'alias', 'text', 'Custom', 'main', false, 'backend', $Table, 'add'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'add'],

            /*** Edit ***/
            // Group :: Main
            ['№', 'id', 'text', 'Title', 'main', false, 'backend', $Table, 'edit'],
            ['Тег', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
            ['Алиас', 'alias', 'text', 'Custom', 'main', false, 'backend', $Table, 'edit'],
            // Group :: Relations
            ['Раздел сайта', 'section', 'select', 'Custom', 'relations', true, 'backend', $Table, 'edit','config','models/Fields.sections'],
            // Group :: Statuses
            ['Статус', 'status', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.status'],
            ['Привелегии', 'privileges', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.privileges'],
            // Group :: Date
            ['Созданно', 'created_at', 'text', 'Date', 'main', true, 'backend', $Table, 'edit'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'edit'],
        ];
    }
}

