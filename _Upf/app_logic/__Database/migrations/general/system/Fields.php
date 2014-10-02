<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fields extends Migration {

    public function up()
    {
        /*** Fields ***/
        \Schema::create('system_fields', function($table)
        {
            /*** Index ***/
            $table->increments('id');
            $table->unique(['table','destination','relation','view']);

            /*** Content ***/
            $table->string('title');
            $table->string('relation');
            $table->string('type');
            $table->string('class');
            $table->boolean('editable');
            $table->string('group');
            $table->string('values');
            $table->string('values_type');


            /*** Relations ***/
            // Example :: articles, meta...
            $table->string('table')->default('section_meta');
            // Values(frontend, backend)
            $table->string('destination')->default('backend');
            // Values(list, snippet, edit, item, add )
            $table->string('view')->default('list');


        });
    }

    public function down()
    {
        \Schema::dropIfExists('system_fields');
    }

}
