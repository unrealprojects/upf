<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Meta extends Migration {

    public function up()
    {
        /*** Meta ***/
        \Schema::create('system_meta', function($table)
        {
            /*** Index ***/
            $table->increments('id');
            $table->unique('alias');
            $table->string('alias')->nullable();

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('keywords')->nullable();

            /*** Filters ***/
            $table->integer('category_id')->default(0);
            $table->integer('region_id')->default(0);

            /*** Relations ***/
            $table->string('section')->nullable();
            $table->integer('comments_id')->default(0);
            $table->integer('user_id')->default(0);

            /*** Statuses ***/
            $table->integer('status')->default(\Config::get('models/Fields.status.default'));
            $table->integer('privileges')->dafault(\Config::get('models/Fields.status.privileges'));
            $table->integer('rating')->default(0);
            $table->integer('views')->default(0);
            $table->boolean('favorite')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        \Schema::dropIfExists('system_meta');
    }

    public static function fields($Table = 'system_meta'){
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
            // Group :: Meta
            ['Алиас', 'alias', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
            ['Title', 'title', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
            ['Descriptions', 'description', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
            ['Keywords', 'keywords', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
            // Group :: Relations
            ['Категория', 'category_id', 'select', 'Relation', 'relations', true, 'backend', $Table, 'edit','model','Categories'],
            ['Регион', 'region_id', 'select', 'Relation', 'relations', true, 'backend', $Table, 'edit','model','Regions'],
            ['Тэги', 'tags', 'multi-select', 'Relation', 'relations', true, 'backend', $Table, 'edit','model','Tags'],



            // Group :: Statuses
            ['Статус', 'status', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.status'],
            ['Привелегии', 'privileges', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.privileges'],
            ['Рейтинг', 'rating', 'text', 'Status', 'statuses', false, 'backend', $Table, 'edit'],
            ['Просмотры', 'views', 'text', 'Status', 'statuses', false, 'backend', $Table, 'edit'],
            ['Избранное', 'favorite', 'radio', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.favorite'],

            // Group :: Date
            ['Создано', 'created_at', 'text', 'Date', 'date', false, 'backend', $Table, 'edit'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'date', false, 'backend', $Table, 'edit'],


        ];
    }


    /*** Related Meta Fields ***/
    public static function MetaFields($Table){
        return [
            /*** *** Backend *** ***/

                /*** Edit ***/

                // Group :: Meta
                ['Алиас', 'meta-alias', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
                ['Title', 'meta-title', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
                ['Descriptions', 'meta-description', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
                ['Keywords', 'meta-keywords', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
                // Group :: Relations
                ['Категория', 'meta-category_id', 'select', 'Relation', 'relations', true, 'backend', $Table, 'edit','model','Categories'],
                ['Регион', 'meta-region_id', 'select', 'Relation', 'relations', true, 'backend', $Table, 'edit','model','Regions'],
                ['Тэги', 'meta-tags', 'multi-select', 'Relation', 'relations', true, 'backend', $Table, 'edit','model','Tags'],
                ['Параметры', 'meta-categories-params', 'params', 'Relation', 'relations', true, 'backend', $Table, 'edit'],
                // Group :: Statuses
                ['Статус', 'meta-status', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.status'],
                ['Привелегии', 'meta-privileges', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.privileges'],
                ['Рейтинг', 'meta-rating', 'text', 'Status', 'statuses', false, 'backend', $Table, 'edit'],
                ['Просмотры', 'meta-views', 'text', 'Status', 'statuses', false, 'backend', $Table, 'edit'],
                ['Избранное', 'meta-favorite', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.favorite'],
                // Group :: Date
                ['Создано', 'meta-created_at', 'text', 'Date', 'date', false, 'backend', $Table, 'edit'],
                ['Обновлено', 'meta-updated_at', 'text', 'Date', 'date', false, 'backend', $Table, 'edit'],




        /*** *** Frontend *** ***/

            /*** List ***/
/*
            // Group :: Relations
            ['Категория',    'meta-categories',     'text',       'Relation',     'relations',      true,     'frontend',     $Table,     'list'],
            ['Регион',       'meta-region',         'text',       'Relation',     'relations',      true,     'frontend',     $Table,     'list'],
            ['Тэги',         'meta-tags',           'text',       'Relation',     'relations',      true,     'frontend',     $Table,     'list'],
            ['Параметры',    'meta-paramsvalues',   'text',       'Relation',     'relations',      true,     'frontend',     $Table,     'list'],

            // Group :: Statuses
            ['Статус',       'meta-status',         'text',        'Status',       'statuses',      true,     'frontend',     $Table,     'list'],
            ['Привелегии',   'meta-privileges',     'text',        'Status',       'statuses',      true,     'frontend',     $Table,     'list'],
            ['Рейтинг',      'meta-rating',         'text',        'Status',       'statuses',      false,    'frontend',     $Table,     'list'],
            ['Просмотры',    'meta-views',          'text',        'Status',       'statuses',      false,    'frontend',     $Table,     'list'],

            // Group :: Date
            ['Созданно',     'meta-created_at',     'text',        'Status',       'date',          false,    'frontend',     $Table,     'list'],
*/
        ];
    }

}
