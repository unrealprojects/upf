<?php
namespace UpfMigrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Regions extends Migration
{
    public function up()
    {
        \Schema::create('filter_regions', function ($table) {
            /*** Index ***/
            $table->increments('id');
            $table->unique('alias');
            $table->string('alias')->nullable();

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();

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

    public static function fields($Table = 'filter_regions')
    {
        return [
            /*** List ***/
            ['Тег', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Алиас', 'alias', 'text', 'Custom', 'main', false, 'backend', $Table, 'list'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'list'],

            /*** Add ***/
            ['Тег', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Алиас', 'alias', 'text', 'Custom', 'main', false, 'backend', $Table, 'add'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'add'],

            /*** Edit ***/
            // Group :: Main
            ['№', 'id', 'text', 'Title', 'main', false, 'backend', $Table, 'edit'],
            ['Тег', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
            ['Алиас', 'alias', 'text', 'Custom', 'main', false, 'backend', $Table, 'edit'],
            // Group :: Relations
            ['Родитель', 'section', 'select', 'Custom', 'relations', true, 'backend', $Table, 'edit', 'model', 'Categories'],
            ['Административное деление', 'administrative_unit', 'select', 'Custom', 'relations', true, 'backend', $Table, 'edit', 'config', 'models/Fields.administrative_unit'],
            ['Тип региона', 'region_type', 'select', 'Custom', 'relations', true, 'backend', $Table, 'edit', 'config', 'models/Fields.region_type'],
            // Group :: Statuses
            ['Статус', 'status', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit', 'config', 'models/Fields.status'],
            ['Привилегии', 'privileges', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit', 'config', 'models/Fields.privileges'],
            // Group :: Date
            ['Созданно', 'created_at', 'text', 'Date', 'main', false, 'backend', $Table, 'edit'],
            ['Обновлено', 'updated_at', 'text', 'Date', 'main', false, 'backend', $Table, 'edit'],
        ];
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Add Item
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function AddItem($Data)
    {
        if (isset($Data) && $Data['title'] && $Data['region']) {

            $Region = new \UpfModels\Regions();

            // Search Parent
            $RegionSearch = explode(' ', $Data['region']);

            if ($Parent = $Region::where('title', 'like', '%' . $RegionSearch[0] . '%')->first()) {

                if ($Parent && !empty($Parent['id'])) {
                    // Add Item
                    $Region = new \UpfModels\Regions();

                    $Region->title = $Data['title'];
                    $Region->alias = $Region->CreateUniqueAlias(\Mascame\Urlify::filter($Data['title']), '\UpfModels\\Regions');
                    $Region->parent_id = $Parent['id'];
                    $Region->administrative_unit = 2;
                    $Region->region_type = 0;
                    $Region->status = 1;
                    $Region->privileges = 0;

                    // Save
                    $Region->save();
                }

            }
        }

    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

