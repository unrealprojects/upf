<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TechonlineCatalog extends Migration {

    /*** КАТАЛОГ ***/
	public function up()
	{

        \\Schema::dropIfExists('catalog_base');
        \\Schema::dropIfExists('catalog_tech');
        \\Schema::dropIfExists('catalog_parts');

        \\Schema::dropIfExists('catalog_admin');

        \\Schema::dropIfExists('catalog_brand');
        \\Schema::dropIfExists('catalog_region');

        \\Schema::dropIfExists('catalog_parts_categories');
        \\Schema::dropIfExists('catalog_tech_categories');

        \\Schema::dropIfExists('catalog_opacity');
        \\Schema::dropIfExists('catalog_statuses');

        \\Schema::dropIfExists('catalog_params');
        \\Schema::dropIfExists('catalog_params_values');
        \\Schema::dropIfExists('catalog_categories_to_params');

        /*** БАЗОВЫЙ КАТАЛОГ ***/
        \\Schema::create('catalog_base', function($table)
        {
            $table->increments('id');

            $table->string('model')->nullable();
            $table->string('logo')->nullable();

            $table->text('description')->nullable();

            $table->text('photos')->nullable();

            $table->integer('rating')->default(0);

            $table->integer('category_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('comments_id')->nullable();
            $table->integer('metadata_id')->nullable();

            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        for($i=1;$i<30;$i++){
            $catalog_base = new \UpfModels\Catalog();




            $catalog_base->model = 'Test Drive Кран '.$i*11;

            /* update metadata */
            $meta_data = new \UpfModels\MetaData();
            $meta_data->alias = Mascame\Urlify::filter($catalog_base->model);
            $meta_data->title=$catalog_base->model;
            $meta_data->description=$catalog_base->model;
            $meta_data->keywords=$catalog_base->model;


            $meta_data->app_section = 'catalog';
            $meta_data->save();
            $catalog_base->metadata_id = $meta_data->id;
            /*end update metadata*/

            $catalog_base->logo = 'logo.jpg';

            $catalog_base->description = 'Строительство качественных автомагистралей, областных и городских дорог не может выполняться без использования грейдеров. Грейдер предоставляет возможность эффективно и в кратчайшие сроки провести профилирование, разравнивание, перемещение грунта и других строительных материалов.';


            $catalog_base->photos =
                json_encode([ 0=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(640+$i, 420, 'transport')],
                  1=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(650+$i, 420, 'transport')],
                  2=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(660+$i, 420, 'transport')],
                  3=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(670+$i, 420, 'transport')],
                  4=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(680+$i, 420, 'transport')],
                  5=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(690+$i, 420, 'transport')]]);


            if($i<10){
                $catalog_base->brand_id=$i;
                $catalog_base->category_id=$i;
            }elseif($i>=10){
                $catalog_base->brand_id=round($i/2);
                $catalog_base->category_id=round($i/2);

            }else{
                $catalog_base->brand_id=round($i/3);
                $catalog_base->category_id=round($i/3);
            }
            $catalog_base->comments_id=$i;
            $catalog_base->save();
        }

        /*** КАТАЛОГ ТЕХНИКИ***/
        \\Schema::create('catalog_tech', function($table)
        {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->integer('price')->nullable();

            $table->text('photos')->nullable();

            $table->integer('model_id')->nullable();

            $table->integer('admin_id')->nullable();
            $table->integer('region_id')->nullable();

            $table->integer('status_id')->nullable();
            $table->integer('opacity_id')->nullable();

            $table->integer('comments_id')->nullable();
            $table->integer('metadata_id')->nullable();

            $table->boolean('active')->default(false);

            $table->integer('rating')->default(0);

            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        for($i=1;$i<30;$i++){
            $catalog_base = new \UpfModels\CatalogTech();

            $catalog_base->name = 'Сдам в аренду кран '.$i;
            $catalog_base->price = $i*98;

            /* update metadata */
            $meta_data = new \UpfModels\MetaData();
            $meta_data->title=$catalog_base->name;
            $meta_data->description=$catalog_base->name;
            $meta_data->keywords=$catalog_base->name;

            $meta_data->alias= Mascame\Urlify::filter($catalog_base->name);
            $meta_data->app_section = 'rent';
            $meta_data->save();
            $catalog_base->metadata_id = $meta_data->id;
            /* end update metadata*/

            $catalog_base->logo  = 'logo.jpg';

            $catalog_base->description ='Строительство качественных автомагистралей, областных и городских дорог не может выполняться без использования грейдеров. Грейдер предоставляет возможность эффективно и в кратчайшие сроки провести профилирование, разравнивание, перемещение грунта и других строительных материалов.';

            $catalog_base->photos =
                json_encode([ 0=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(640+$i, 420, 'transport')],
                    1=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(650+$i, 420, 'transport')],
                    2=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(660+$i, 420, 'transport')],
                    3=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(670+$i, 420, 'transport')],
                    4=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(680+$i, 420, 'transport')],
                    5=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(690+$i, 420, 'transport')]]);

            $catalog_base->model_id=$i;
            $catalog_base->admin_id=$i;
            $catalog_base->region_id=$i;
            $catalog_base->comments_id=$i;

            $catalog_base->status_id=2;
            $catalog_base->opacity_id=2;
            $catalog_base->active=true;
            $catalog_base->save();
        }


        /*** КАТАЛОГ ЗАПЧАСТЕЙ***/
        \\Schema::create('catalog_parts', function($table)
        {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();

            $table->string('brand')->nullable();
            $table->string('price')->nullable();

            $table->text('photos')->nullable();

            $table->integer('category_id')->nullable();
            $table->integer('admin_id')->nullable();

            $table->integer('status_id')->nullable();
            $table->integer('opacity_id')->nullable();

            $table->integer('comments_id')->nullable();
            $table->integer('metadata_id')->nullable();

            $table->boolean('active')->default(false);

            $table->integer('rating')->default(0);

            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        for($i=1;$i<30;$i++){
            $catalog_base = new \UpfModels\CatalogParts();

            $catalog_base->name = 'Запчасть для крана '.$i;
            $catalog_base->price = $i*98 . ' руб.';

            /* update metadata */
            $meta_data = new \UpfModels\MetaData();
            $meta_data->title=$catalog_base->name;
            $meta_data->description=$catalog_base->name;
            $meta_data->keywords=$catalog_base->name;

            $meta_data->alias = Mascame\Urlify::filter($catalog_base->name);
            $meta_data->app_section = 'parts    ';
            $meta_data->save();
            $catalog_base->metadata_id = $meta_data->id;
            /* end update metadata*/

            $catalog_base->logo  = 'logo.jpg';

            $catalog_base->description ='Строительство качественных автомагистралей, областных и городских дорог не может выполняться без использования грейдеров. Грейдер предоставляет возможность эффективно и в кратчайшие сроки провести профилирование, разравнивание, перемещение грунта и других строительных материалов.';


            $catalog_base->photos =
                json_encode([ 0=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(640+$i, 420, 'technics')],
                    1=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(650+$i, 420, 'technics')],
                    2=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(660+$i, 420, 'technics')],
                    3=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(670+$i, 420, 'technics')],
                    4=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(680+$i, 420, 'technics')],
                    5=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(690+$i, 420, 'technics')]
                ]);

            $catalog_base->category_id=$i;
            $catalog_base->admin_id=$i;
            $catalog_base->comments_id=$i;

            $catalog_base->status_id=2;
            $catalog_base->opacity_id=2;
            $catalog_base->active=true;
            $catalog_base->save();
        }

        /*** АДМИНИСТРАТОР ***/
        \\Schema::create('catalog_admin', function($table)
        {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();

            $table->string('adress')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('skype')->nullable();
            $table->string('website')->nullable();

            $table->text('photos')->nullable();

            $table->integer('region_id')->nullable();

            $table->boolean('active')->default(false);

            $table->integer('comments_id')->nullable();
            $table->integer('metadata_id')->nullable();
            $table->integer('rating')->default(0);

            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });


        for($i=1;$i<30;$i++){
            $catalog_base = new \UpfModels\CatalogAdmin();

            $catalog_base->name = 'Транспортная кампания  '.$i;

            /* update metadata */
            $meta_data = new \UpfModels\MetaData();
            $meta_data->title=$catalog_base->name;
            $meta_data->description=$catalog_base->name;
            $meta_data->keywords=$catalog_base->name;

            $meta_data->alias= Mascame\Urlify::filter($catalog_base->name);
            $meta_data->app_section = 'sellers';
            $meta_data->save();
            $catalog_base->metadata_id = $meta_data->id;
            /* end update metadata*/

            $catalog_base->logo  = 'logo.jpg';

            $catalog_base->description ='Строительство качественных автомагистралей, областных и городских дорог не может выполняться без использования грейдеров. Грейдер предоставляет возможность эффективно и в кратчайшие сроки провести профилирование, разравнивание, перемещение грунта и других строительных материалов.';


            $catalog_base->adress = 'г. Москва,пр. Ленина д. 31, оф. 3';
            $catalog_base->phone = '7900'. $i*11 . $i*23 . $i*11 . $i*23;
            $catalog_base->skype = 'skypecompany'. $i;
            $catalog_base->email = 'company'. $i . '@gmail.com';
            $catalog_base->website = 'http://company'. $i . '.com';
            $catalog_base->comments_id=$i;


            $catalog_base->photos =
                json_encode([ 0=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(640+$i, 420, 'business')],
                    1=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(650+$i, 420, 'business')],
                    2=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(660+$i, 420, 'business')],
                    3=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(670+$i, 420, 'business')],
                    4=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(680+$i, 420, 'business')],
                    5=>["name"=>"Big Japan Car","src"=>Faker\Provider\Image::imageUrl(690+$i, 420, 'business')]]);

            $catalog_base->region_id=$i;

            $catalog_base->active=true;
            $catalog_base->save();
        }

        /*** БРЕНД ***/
        \\Schema::create('catalog_brand', function($table)
        {
            $table->increments('id');
            $table->string('alias')->nullable();
            $table->string('name')->nullable();
            $table->string('foreign')->default(false);
        });

        $brands = [
                'Mercedes-Benz',
                'MAN',
                'Foton',
                'Carmix',
                'Putzmeister',
                'Brinkmann',
                'Zettelmeyer',
                'Vicon',
                'IHI'
            ];

        foreach($brands as $brand){
            $catalog_brand = new \UpfModels\CatalogBrand();
            $catalog_brand->name=$brand;
            $catalog_brand->alias = Mascame\Urlify::filter($catalog_brand->name);
            $catalog_brand->foreign = true;
            $catalog_brand->save();
        }

        $brands = [
            'КамАЗ',
            'КрАЗ',
            'МТЗ',
            'УРБ',
        ];

        foreach($brands as $brand){
            $catalog_brand = new \UpfModels\CatalogBrand();
            $catalog_brand->name=$brand;
            $catalog_brand->alias = Mascame\Urlify::filter($catalog_brand->name);
            $catalog_brand->save();
        }



        /*** СОСТОЯНИЕ ***/
        \\Schema::create('catalog_opacity', function($table)
        {
            $table->increments('id');
            $table->string('name')->nullable();
        });

        $opacity = [
            'Плохое',
            'Среднее',
            'Хорошее',
            'Новый'
        ];

        foreach($opacity as $opacity_elem){
            $catalog_opacity = new \UpfModels\CatalogOpacity();
            $catalog_opacity->name=$opacity_elem;
            $catalog_opacity->save();
        }

        /*** СТАТУСЫ ***/
        \\Schema::create('catalog_statuses', function($table)
        {
            $table->increments('id');
            $table->string('name')->nullable();
        });

        $statuses = [
            'Занято',
            'Свободно'
        ];

        foreach($statuses as $status){
            $catalog_opacity = new \UpfModels\CatalogStatuses();
            $catalog_opacity->name=$status;
            $catalog_opacity->save();
        }

        /*** ПАРАМЕТРЫ ДЛЯ ТЕХНИКИ ***/
        \\Schema::create('catalog_params', function($table){
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('alias')->nullable();

            $table->integer('min_value')->nullable();
            $table->integer('max_value')->nullable();

            $table->string('dimension')->nullable();
        });

        $params = [
            ['name'=>'Эксплуатационная масса','alias'=>'size','min'=>100,'max'=>20000,'dimension'=>'кг.'],
            ['name'=>'Грузоподъёмность','alias'=>'sizer','min'=>10,'max'=>20000,'dimension'=>'кг.'],
            ['name'=>'Вместимость кузова','alias'=>'sizet','min'=>0.5,'max'=>100,'dimension'=>'м3'],
            ['name'=>'Мощьность двигателя','alias'=>'powery','min'=>10,'max'=>1000,'dimension'=>'лс'],
            ['name'=>'Ширина гусениц','alias'=>'sizefgh','min'=>100,'max'=>500,'dimension'=>'мм'],
            ['name'=>'Скорость передвижения','alias'=>'sizedf','min'=>100,'max'=>500,'dimension'=>'км/ч'],
            ['name'=>'Топливный бак','alias'=>'sizergg','min'=>20,'max'=>1000,'dimension'=>'л.'],

            ['name'=>'Скорость1','alias'=>'speedrr','min'=>10,'max'=>100,'dimension'=>'км/ч'],
            ['name'=>'Грузоподъемность1','alias'=>'loadee','min'=>10,'max'=>50,'dimension'=>'т'],
            ['name'=>'Объем двигателя1','alias'=>'volumewer','min'=>10,'max'=>200,'dimension'=>'л'],
            ['name'=>'Размер ковша1','alias'=>'sizedrg','min'=>100,'max'=>500,'dimension'=>'дв.кв.']
        ];

        foreach($params as $param){
            $catalog_param = new \UpfModels\CatalogParams();
            $catalog_param->name=$param['name'];
            $catalog_param->alias=$param['alias'];
            $catalog_param->min_value=$param['min'];
            $catalog_param->max_value=$param['max'];
            $catalog_param->dimension=$param['dimension'];
            $catalog_param->save();
        }


        /*** ЗНАЧЕНИЯ ПАРАМЕТРОВ ДЛЯ ТЕХНИКИ ***/
        \\Schema::create('catalog_params_values', function($table)
        {
            $table->increments('id');

            $table->integer('model_id')->nullable();
            $table->integer('param_id')->nullable();

            $table->integer('value')->nullable();
        });

        $params_values = [
            ['model_id'=>1,'param_id'=>1,'value'=>30],
            ['model_id'=>1,'param_id'=>2,'value'=>40],
            ['model_id'=>1,'param_id'=>3,'value'=>50],
            ['model_id'=>2,'param_id'=>1,'value'=>35],
            ['model_id'=>2,'param_id'=>2,'value'=>45],
            ['model_id'=>2,'param_id'=>3,'value'=>55],
            ['model_id'=>2,'param_id'=>4,'value'=>60],
            ['model_id'=>3,'param_id'=>1,'value'=>70],
            ['model_id'=>3,'param_id'=>2,'value'=>65],
            ['model_id'=>3,'param_id'=>3,'value'=>75],
        ];

        foreach($params_values as $param_value){
            $catalog_param = new \UpfModels\CatalogParamsValues();
            $catalog_param->model_id=$param_value['model_id'];
            $catalog_param->param_id=$param_value['param_id'];
            $catalog_param->value=$param_value['value'];
            $catalog_param->save();
        }

        /*** ОТНОШЕНИЕ ПАРАМЕТРОВ К КАТЕГОРИИ ТЕХНИКИ ***/
        $params_relations = [
            ['param_id'=>1,'category_id'=>1],
            ['param_id'=>1,'category_id'=>2],
            ['param_id'=>1,'category_id'=>3],
            ['param_id'=>1,'category_id'=>4],
            ['param_id'=>2,'category_id'=>1],
            ['param_id'=>2,'category_id'=>2],
            ['param_id'=>2,'category_id'=>3],
            ['param_id'=>3,'category_id'=>1],
            ['param_id'=>3,'category_id'=>2],
            ['param_id'=>4,'category_id'=>3],
            ['param_id'=>4,'category_id'=>4],
            ['param_id'=>1,'category_id'=>9],
            ['param_id'=>2,'category_id'=>9],
            ['param_id'=>3,'category_id'=>9],
            ['param_id'=>4,'category_id'=>9],
            ['param_id'=>5,'category_id'=>9],
            ['param_id'=>6,'category_id'=>9],
            ['param_id'=>7,'category_id'=>9],

        ];

        foreach($params_relations as $rel){
            $params_rel = new \UpfModels\CatalogPartsCategoriesToParams();
            $params_rel->param_id=$rel['param_id'];
            $params_rel->category_id=$rel['category_id'];
            $params_rel->save();
        }


        /* Мета для основных страниц */
        $meta_data = new \UpfModels\MetaData();
        $meta_data->title="Каталог Стройтехники";
        $meta_data->description="Каталог Стройтехники";
        $meta_data->keywords="Каталог Стройтехники";
        $meta_data->alias = '';
        $meta_data->app_section = 'catalog';
        $meta_data->save();

        $meta_data = new \UpfModels\MetaData();
        $meta_data->title="Аренда Стройтехники";
        $meta_data->description="Аренда Стройтехники";
        $meta_data->keywords="Аренда Стройтехники";
        $meta_data->alias = '';
        $meta_data->app_section = 'rent';
        $meta_data->save();

        $meta_data = new \UpfModels\MetaData();
        $meta_data->title="Запчасти и сервис";
        $meta_data->description="Запчасти и сервис";
        $meta_data->keywords="Запчасти и сервис";
        $meta_data->alias = '';
        $meta_data->app_section = 'parts';
        $meta_data->save();

        $meta_data = new \UpfModels\MetaData();
        $meta_data->title="Арендодатели";
        $meta_data->description="Арендодатели";
        $meta_data->keywords="Арендодатели";
        $meta_data->alias = '';
        $meta_data->app_section = 'sellers';
        $meta_data->save();

        $meta_data = new \UpfModels\MetaData();
        $meta_data->title="Новости";
        $meta_data->description="Новости";
        $meta_data->keywords="Новости";
        $meta_data->alias = '';
        $meta_data->app_section = 'news';
        $meta_data->save();

        $meta_data = new \UpfModels\MetaData();
        $meta_data->title="Личный Кабнет";
        $meta_data->description="Личный Кабнет";
        $meta_data->keywords="Личный Кабнет";
        $meta_data->alias = '';
        $meta_data->app_section = 'cabinet';
        $meta_data->save();
	}

	public function down()
	{
        \\Schema::dropIfExists('catalog_base');
        \\Schema::dropIfExists('catalog_tech');
        \\Schema::dropIfExists('catalog_parts');

        \\Schema::dropIfExists('catalog_admin');

        \\Schema::dropIfExists('catalog_brand');


        \\Schema::dropIfExists('catalog_opacity');
        \\Schema::dropIfExists('catalog_statuses');

        \\Schema::dropIfExists('catalog_params');
        \\Schema::dropIfExists('catalog_params_values');
        \\Schema::dropIfExists('catalog_categories_to_params');
	}
}
