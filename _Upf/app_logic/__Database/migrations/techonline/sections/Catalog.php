<?php
namespace UpfMigrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Catalog extends Migration
{
    public static function fields($Table = 'section_catalog')
    {
        return [
            /*** List ***/
            ['Модель', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Короткое описание', 'intro', 'text', 'Custom', 'main', true, 'backend', $Table, 'list'],
            ['Обновлено', 'meta-updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'list'],

            /*** Add ***/
            ['Модель', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Короткое описание', 'intro', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'add'],
            ['Подробное описание', 'text', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'add'],
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', $Table, 'add', ''],

            /*** Edit ***/
            // Group :: Main
            ['№', 'id', 'text', 'Title', 'main', false, 'backend', $Table, 'edit'],
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
            ['Короткое описание', 'intro', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            ['Подробное описание', 'text', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            ['Параметры', 'meta-categories-params', 'params', 'Relation', 'relations', true, 'backend', $Table, 'edit'],

            // Group :: Media
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', $Table, 'edit', ''],
            ['Галерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'backend', $Table, 'edit'],
        ];
    }

    public function up()
    {
        /*** Catalog ***/
        \Schema::create('section_catalog', function ($table) {
            /*** Index ***/
            $table->increments('id');

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();
            $table->text('intro')->nullable();
            $table->text('text')->nullable();

            /*** Relations ***/
            $table->integer('meta_id')->default(0);
        });
    }

    public function down()
    {
        \Schema::dropIfExists('section_catalog');
    }


    /***
     * 1 Мини-спецтехника
     * 2 Землеройная техника + Карьерная
     * 3 Подъемная техника
     * 4 Дорожная и уплотнительная техника
     * 5 Коммунальная техника
     * 6 Бетонное оборудование
     * 7 Коммерческий транспорт
     * 8 Складская техника
     ***/

    /***
     * Todo :: Change category In 2 adn 3
     * Todo :: Load Images
     ***/
    public function AddItem($Data)
    {
        if (isset($Data) && isset($Data['main'])) {

            // Set
            $Categories_Parent_Id = 2;
            $Photo_Website = 'http://maxi-exkavator.ru/';
            // Set

//        print_r($Data);
//        exit;

            $Faker = \Faker\Factory::create();

            $Catalog = new \UpfModels\Catalog();
            $Categories = new \UpfModels\Categories();

            $Tags = new \UpfModels\Tags();
            $TagsToItems = new \UpfModels\TagsToItems();

            $Params = new \UpfModels\Params();
            $ParamsToCategory = new \UpfModels\ParamsToCategories();
            $ParamsValues = new \UpfModels\ParamsValues();


            /*** Content ***/
            $Catalog->title = $Data['main']['title'];
            $Catalog->logotype = (isset($Data['main']['logotype'])) ? $Photo_Website . $Data['main']['logotype'] : '';
            $Catalog->intro = $Data['main']['intro'];
            $Catalog->text = $Data['main']['intro'];


            /*** Parse Category ***/
            if ($Category = $Categories::where('title', $Data['relations']['category'])->first()) {
                $Category_Id = $Category['id'];
            }
            else {
                $Categories->alias = $Categories->CreateUniqueAlias(\Mascame\Urlify::filter($Data['relations']['category']), '\UpfModels\\Categories');
                $Categories->title = $Data['relations']['category'];
                $Categories->section = 'catalog';
                $Categories->status = 1;
                $Categories->privileges = 0;


                // To Change
                $Categories->parent_id = $Categories_Parent_Id;
                $Categories->save();
                $Category_Id = $Categories->id;
            }


            /*** Parse Producer (Tags) ***/
            if ($Tag = $Tags::where('title', $Data['relations']['producer'])->first()) {
                $Tags_Id = $Tag['id'];
            }
            else {
                $Tags->alias = $Categories->CreateUniqueAlias(\Mascame\Urlify::filter($Data['relations']['producer']), '\UpfModels\\Tags');
                $Tags->title = $Data['relations']['producer'];
                $Tags->section = 'catalog';
                $Tags->status = 1;
                $Tags->privileges = 0;


                // To Change
                $Tags->save();
                $Tags_Id = $Tags->id;
            }


            /*** Meta ***/
            $DataMeta = [
                /*** Content ***/
                'title'       => $Data['main']['title'],
                'description' => $Data['main']['intro'],
                'keywords'    => $Data['main']['intro'],
                /*** Relations ***/
                'section'     => 'catalog',
                'category_id' => $Category_Id,
                /*** Statuses ***/
                'status'      => 1,
                'privileges'  => 0,
                'rating'      => 0,
                'favorite'    => 0,
            ];


            // Add Tag(Producer)


            if ($Catalog->meta_id = \UpfSeeds\MetaSeeder::AddMetaToSection($DataMeta)[0]) {


                $TagsToItems->item_id = $Catalog->meta_id;
                $TagsToItems->tag_id = $Tags_Id;
                $TagsToItems->section = 'catalog';
                $TagsToItems->save();


                // Add Params

                foreach ($Data['relations']['params'] as $Param) {
                    if (!empty($Param['param']['value']) && !empty($Param['param']['title']) && strlen($Param['param']['value']) > 0 && strlen($Param['param']['title']) > 0) {
                        if ($ParamItem = $Params::where('title', $Param['param']['title'])->first()) {
                            $Param_Id = $ParamItem->id;
                        }
                        else {
                            $ParamItem = new \UpfModels\Params();
                            $Param['param']['title'] = htmlentities($Param['param']['title']);
                            $ParamItem->alias = $Categories->CreateUniqueAlias(\Mascame\Urlify::filter($Param['param']['title']), '\UpfModels\\Params');
                            $ParamItem->title = $Param['param']['title'];
                            $ParamItem->section = 'catalog';

                            $ParamItem->status = 1;

                            $ParamItem->dimension = '';

                            // Parse Value

                            $Param['param']['value'] = str_replace('&nbsp;', ' ', $Param['param']['value']);
                            $ParamParts = explode(' ', $Param['param']['value']);
                            if (is_numeric($ParamParts[0])) {
                                $Param['param']['value'] = $ParamParts[0];
                                $ParamItem->privileges = 0;
                            }
                            else {
                                $ParamItem->privileges = 1;
                            }

                            // To Change
                            $ParamItem->save();
                            $Param_Id = $ParamItem->id;


                            $ParamsToCategory = new \UpfModels\ParamsToCategories();
                            $ParamsToCategory->category_id = $Category_Id;
                            $ParamsToCategory->param_id = $Param_Id;

                            $ParamsToCategory->save();
                        }

                        // Take Numbers
                        $Param['param']['value'] = htmlentities($Param['param']['value']);
                        $ParamParts = explode(' ', $Param['param']['value']);
                        if (is_numeric($ParamParts[0])) {
                            $Param['param']['value'] = $ParamParts[0];
                        }


                        $ParamsValues = new \UpfModels\ParamsValues();
                        $ParamsValues->value = $Param['param']['value'];
                        $ParamsValues->item_id = $Catalog->meta_id;
                        $ParamsValues->param_id = $Param_Id;
                        if (!$ParamsValues::where('item_id', $Catalog->meta_id)->where('param_id', $Param_Id)->first()) {
                            $ParamsValues->save();
                        }
                    }
                }

                $Catalog->save();
            }
        }

    }
}
