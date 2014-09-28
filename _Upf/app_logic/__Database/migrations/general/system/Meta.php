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
            $table->boolean('favorite')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        \Schema::dropIfExists('system_meta');
    }

}
