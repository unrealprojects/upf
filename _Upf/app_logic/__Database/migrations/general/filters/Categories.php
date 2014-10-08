<?php

namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Categories extends Migration {
    public function up()
    {
        \Schema::create('filter_categories', function($table)
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
            $table->string('parent_id')->dafault(0);

            /*** Statuses ***/
            $table->boolean('status')->dafault(\Config::get('models/Fields.status.default'));
            $table->boolean('privileges')->dafault(\Config::get('models/Fields.privileges.default'));
            $table->timestamps();
        });
    }

	public function down()
	{
        \Schema::dropIfExists('filter_categories');
	}

    public static function fields($Table = 'filter_categories'){
        return [
            /*** List ***/
            ['Категория', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Алиас', 'alias', 'text', 'Custom', 'main', false, 'backend', $Table, 'list'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', false, 'backend', $Table, 'list'],

            /*** Add ***/
            ['Категория', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Раздел сайта', 'section', 'select', 'Custom', 'relations', true, 'backend', $Table, 'add','config','models/Fields.sections'],
            ['Родитель', 'parent_id', 'select', 'Custom', 'relations', true, 'backend', $Table, 'add    ','model','Categories'],

            /*** Edit ***/
            // Group :: Main
            ['№', 'id', 'text', 'Title', 'main', false, 'backend', $Table, 'edit'],
            ['Категория', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
            ['Алиас', 'alias', 'text', 'Custom', 'main', false, 'backend', $Table, 'edit'],
            // Group :: Relations
            ['Раздел сайта', 'section', 'select', 'Custom', 'relations', true, 'backend', $Table, 'edit','config','models/Fields.sections'],
            ['Родитель', 'parent_id', 'select', 'Custom', 'relations', true, 'backend', $Table, 'edit','model','Categories'],
            // Group :: Statuses
            ['Статус', 'status', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.status'],
            ['Привелегии', 'privileges', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.privileges'],
            // Group :: Date
            ['Созданно', 'created_at', 'text', 'Date', 'main', true, 'backend', $Table, 'edit'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'edit'],
        ];
    }
}

