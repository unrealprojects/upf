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

            /*** Content ***/
            $table->string('author')->nullable();
            $table->text('post')->nullable();

            /*** Relations ***/
            $table->integer('section')->nullable();
            $table->integer('wall_id')->nullable();
            $table->integer('author_id')->nullable();
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

}
