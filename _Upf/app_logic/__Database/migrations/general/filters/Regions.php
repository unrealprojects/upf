<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Regions extends Migration {
    public function up()
    {
        \Schema::create('filter_regions', function($table)
        {
            /*** Index ***/
            $table->increments('id');
            $table->unique('alias');
            $table->string('alias')->nullable();

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();

            $table->enum('type',array('Области','Республики','Автономные округа','Края'))->default('Области');

            /*** Relations***/
            $table->integer('administrative_unit')->default(\Config::get('models/Fields.administrative_unit.default'));
            $table->integer('region_type')->default(\Config::get('models/Fields.region_type.default'));
            $table->integer('parent_id')->default(0);

            /*** Statuses ***/
            $table->boolean('status')->dafault(\Config::get('models/Fields.status.default'));
            $table->boolean('privileges')->dafault(\Config::get('models/Fields.privileges.default'));
            $table->timestamps();
        });
    }

	public function down()
	{
        \Schema::dropIfExists('filter_regions');
	}
}

