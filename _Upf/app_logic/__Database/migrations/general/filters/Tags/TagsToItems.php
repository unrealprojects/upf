<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TagsToItems extends Migration {
	public function up()
	{
        \Schema::create('filter_tags_to_items', function($table)
        {
            /*** Index ***/
            $table->increments('id');
            $table->unique(['item_id', 'tag_id', 'section']);

            /*** Relations ***/
            $table->string('section')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('tag_id')->nullable();


        });
	}

	public function down()
	{
        \Schema::dropIfExists('filter_tags_to_items');
	}
}

