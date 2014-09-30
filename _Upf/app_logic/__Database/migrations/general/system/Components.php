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

            /*** Statuses ***/
            $table->string('destination')->nullable();
            $table->integer('status')->default(\Config::get('models/Fields.status.active'));
            $table->boolean('favorite')->default(0);
        });
    }

    public function down()
    {
        \Schema::dropIfExists('system_components');
    }

}
