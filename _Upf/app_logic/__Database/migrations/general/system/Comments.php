<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comments extends Migration {
	public function up()
	{
        \Schema::create('system_comments', function($table)
        {
            /*** Index ***/
            $table->increments('id');
            $table->text('alias')->nullable();

            /*** Content ***/
            $table->string('author')->nullable();
            $table->text('post')->nullable();


            /*** Relations ***/
            $table->integer('section')->nullable();
            $table->integer('wall_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('parent_id')->nullable();

            /*** Statuses ***/
            $table->boolean('status')->default(\Config::get('models/Fields.status.default'));
            $table->boolean('privileges')->dafault(\Config::get('models/Fields.status.privileges'));
            $table->integer('rating')->default(0);
            $table->timestamps();
        });
	}

	public function down()
	{
        \Schema::dropIfExists('system_comments');
	}

    public static function fields($Table = 'system_comments'){
        return [
            /*** List ***/
            ['Автор', 'author', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Пост', 'post', 'text', 'Custom', 'main', true, 'backend', $Table, 'list'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'list'],

            /*** Add ***/
            ['Автор', 'author', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Пост', 'post', 'text', 'Custom', 'main', true, 'backend', $Table, 'add'],

            /*** Edit ***/
            // Group :: Main
            ['№', 'id', 'text', 'Title', 'main', false, 'backend', $Table, 'edit'],
            ['Автор', 'author', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
            ['Пост', 'post', 'text', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            // Group :: Relations
            ['Раздел сайта', 'section', 'select', 'Custom', 'relations', true, 'backend', $Table, 'edit','config','models/Fields.sections'],
//            ['Материал', 'wall_id', 'select', 'Custom', 'relations', true, 'backend', $Table, 'edit','section',''],
            ['Автор', 'user_id', 'select', 'Custom', 'relations', true, 'backend', $Table, 'edit','model','Users'],
            // Group :: Statuses
            ['Статус', 'status', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.status'],
            ['Привелегии', 'privileges', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.privileges'],
            ['Рейтинг', 'rating', 'text', 'Status', 'statuses', false, 'backend', $Table, 'edit'],
            // Group :: Date
            ['Созданно', 'created_at', 'text', 'Date', 'main', false, 'backend', $Table, 'edit'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', false, 'backend', $Table, 'edit']
        ];
    }
}
