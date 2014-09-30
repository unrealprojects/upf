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
            $table->integer('status')->default(\Config::get('models/Fields.status.active'));
            $table->string('purpose')->nullable();
            $table->boolean('favorite')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        \Schema::dropIfExists('system_components');
    }

}
