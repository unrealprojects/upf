<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Params extends Migration {
	public function up()
	{
        \Schema::create('filter_params', function($table){
            /*** Index ***/
            $table->increments('id');
            $table->unique('alias');
            $table->string('alias')->nullable();

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();
            $table->string('dimension')->nullable();

            /*** Settings ***/
            $table->string('param_type')->nullable();
            $table->string('param_set')->nullable();
            $table->integer('param_min')->nullable();
            $table->integer('param_max')->nullable();

            /*** Relations ***/
            $table->string('section')->nullable();

            /*** Statuses ***/
            $table->boolean('status')->dafault(2);
            $table->boolean('privileges')->dafault(0);
            $table->timestamps();
        });
	}

	public function down()
	{
        \Schema::dropIfExists('filter_params');
	}

    public static function fields($Table = 'filter_params'){
        return [
            /*** List ***/
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Алиас', 'alias', 'text', 'Custom', 'main', false, 'backend', $Table, 'list'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'list'],

            /*** Add ***/
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Алиас', 'alias', 'text', 'Custom', 'main', false, 'backend', $Table, 'add'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'add'],

            /*** Edit ***/
            // Group :: Main
            ['№', 'id', 'text', 'Title', 'main', false, 'backend', $Table, 'edit'],
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
            ['Алиас', 'alias', 'text', 'Custom', 'main', false, 'backend', $Table, 'edit'],
            ['Min', 'param_min', 'text', 'Custom', 'main', true, 'backend', 'filter_params', 'edit'],
            ['Max', 'param_max', 'text', 'Custom', 'main', true, 'backend', 'filter_params', 'edit'],
            ['Размерность', 'dimension', 'text', 'Custom', 'main', true, 'backend', 'filter_params', 'edit'],
            // Group :: Relations
            ['Раздел сайта', 'section', 'select', 'Custom', 'relations', true, 'backend', $Table, 'edit','config','models/Fields.sections'],
            ['Категории', 'categories', 'multi-select', 'Relation', 'relations', true, 'backend', $Table, 'edit','model','Categories'],
            // Group :: Statuses
            ['Статус', 'status', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.status'],
            ['Привелегии', 'privileges', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.privileges'],
            // Group :: Date
            ['Созданно', 'created_at', 'text', 'Date', 'main', true, 'backend', $Table, 'edit'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'edit'],
        ];
    }
}

