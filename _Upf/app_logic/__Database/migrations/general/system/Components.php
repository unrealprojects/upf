<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Components extends Migration {

    public function up()
    {
        /*** Meta ***/
        \Schema::create('system_components', function($table)
        {
            /*** Index ***/
            $table->increments('id');
            $table->unique('alias');
            $table->string('alias')->nullable();

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            /*** Component Type ***/
            $table->string('component_type')->nullable();
            /*** Statuses ***/
            $table->string('destination')->nullable();
            $table->integer('status')->default(\Config::get('models/Fields.status.active'));
            $table->boolean('favorite')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        \Schema::dropIfExists('system_components');
    }

    public static function fields($Table = 'system_components'){
        return [
            /*** List ***/
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Алиас', 'alias', 'text', 'Custom', 'main', false, 'backend', $Table, 'list'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', false, 'backend', $Table, 'list'],

            /*** Add ***/
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Описание', 'description', 'textarea', 'Title', 'main', false, 'backend', $Table, 'add'],
            ['Алиас', 'alias', 'text', 'Custom', 'main', false, 'backend', $Table, 'add'],

            /*** Edit ***/
            // Group :: Main
            ['№', 'id', 'text', 'Title', 'main', false, 'backend', $Table, 'edit'],
            // Group :: Meta
            ['Алиас', 'alias', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
            ['Заголовок', 'title', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
            ['Описание', 'description', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
            ['Избранное', 'favorite', 'radio', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.favorite'],
            // Group :: Relations
            ['Тип компонента', 'component_type', 'select', 'Status', 'relations', true, 'backend', $Table, 'edit','config','models/Fields.component_type'],
            // Group :: Statuses
            ['Статус', 'status', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.status'],
            ['Назначение', 'destination', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.destination'],
            // Group :: Date
            ['Создано', 'created_at', 'text', 'Date', 'date', false, 'backend', $Table, 'edit'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'date', false, 'backend', $Table, 'edit'],
        ];
    }
}
