<?php
namespace UpfMigrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Parts extends Migration {
    public function up()
    {
        /***  ***/
        \Schema::create('section_parts', function($table)
        {
            /*** Index ***/
            $table->increments('id');

            /*** Content ***/
            $table->string('title')->nullable();
            $table->string('logotype')->nullable();
            $table->string('price')->nullable();
            $table->text('intro')->nullable();
            $table->text('text')->nullable();

            /*** Relations ***/
            $table->integer('meta_id')->default(0);
            $table->integer('user_id')->default(0);

            /*** Status ***/
            $table->integer('condition')->nullable();
        });
    }

    public function down()
    {
        \Schema::dropIfExists('section_parts');
    }

    public static function fields($Table = 'section_parts'){
        return [
            /*** List ***/
            ['Запчасть/Услуга', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Короткое описание', 'intro', 'text', 'Custom', 'main', true, 'backend', $Table, 'list'],
            ['Цена', 'price', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Обновлено', 'meta-updated_at', 'text', 'Date', 'main', false, 'backend', $Table, 'list'],

            /*** Add ***/
            ['Запчасть/Услуга', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Короткое описание', 'intro', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'add'],
            ['Подробное описание', 'text', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'add'],
            ['Цена', 'price', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Регион', 'meta-region_id', 'select', 'Relation', 'relations', true, 'backend', $Table, 'add','model','Regions'],
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', $Table, 'add',''],

            /*** Edit ***/
            // Group :: Main
            ['№', 'id', 'text', 'Title', 'main', false, 'backend', $Table, 'edit'],
            ['Запчасть/Услуга', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
            ['Короткое описание', 'intro', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            ['Подробное описание', 'text', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            ['Цена', 'price', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
            ['Качество', 'condition', 'select', 'Title', 'main', true, 'backend', $Table, 'edit','config','models/Fields.condition'],
            // Relations
            ['Пользователь', 'user_id', 'select', 'Title', 'main', true, 'backend', $Table, 'edit', 'model', 'Users'],
            // Group :: Media
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', $Table, 'edit',''],
            ['Галерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'backend', $Table, 'edit'],



            /*** Edit :: Frontend ***/
            // Group :: Main
            ['Основная информация', 'divider_1', 'divider', 'Title', 'main', true, 'frontend', $Table, 'edit'],

            ['Запчасть/Услуга', 'title', 'text', 'Title', 'main', true, 'frontend', $Table, 'edit'],
            ['Короткое описание', 'intro', 'textarea', 'Custom', 'main', true, 'frontend', $Table, 'edit'],
            ['Подробное описание', 'text', 'textarea', 'Custom', 'main', true, 'frontend', $Table, 'edit'],
            ['Цена', 'price', 'text', 'Title', 'main', true, 'frontend', $Table, 'edit'],
            ['Качество', 'condition', 'select', 'Title', 'main', true, 'frontend', $Table, 'edit','config','models/Fields.condition'],

            ['Регион', 'meta-region_id', 'select', 'Relation', 'relations', true, 'frontend', $Table, 'edit','model','Regions'],
            ['Тэги', 'meta-tags', 'multi-select', 'Relation', 'relations', true, 'frontend', $Table, 'edit','model','Tags'],
            ['Категория', 'meta-category_id', 'select', 'Relation', 'relations', true, 'frontend', $Table, 'edit','model','Categories'],


            ['Медиа информация', 'divider_2', 'divider', 'Title', 'main', true, 'frontend', $Table, 'edit'],
            // Group :: Media
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'frontend', $Table, 'edit',''],
            ['Галерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'frontend', $Table, 'edit'],
        ];
    }



    public function AddItem($Data, $Region = false, $User_Id = false)
    {
        if (isset($Data) && isset($Data['main'])) {

            // Set
            $Photo_Website = 'http://exkavator.ru/';
            // Set

            $Part = new \UpfModels\Parts();

            /*** Content ***/
            $Part->title = $Data['main']['title'];
            $Part->logotype = (isset($Data['main']['logotype'])) ? $Photo_Website . $Data['main']['logotype'] : '';
            $Part->intro = trim($Data['main']['intro']);
            $Part->text = trim($Data['main']['text']);

            $Part->user_id = $User_Id;


            /*** Meta ***/
            $DataMeta = [
                /*** Content ***/
                'title'       => $Data['main']['title'],
                'description' => $Data['main']['intro'],
                'keywords'    => $Data['main']['intro'],
                /*** Relations ***/
                'section'     => 'parts',
                'category_id' => '',
                'region_id' => $Region,
                /*** Statuses ***/
                'status'      => 1,
                'privileges'  => 0,
                'rating'      => 0,
                'favorite'    => 0
            ];

            if ($Meta = \UpfSeeds\MetaSeeder::AddMetaToSection($DataMeta)) {
                $Part->meta_id = $Meta[0];
                $Part->save();
            }
        }
    }
}