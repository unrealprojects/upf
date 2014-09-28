<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CatalogGoods extends Migration {

	public function up()
	{
        $catalog_base = new \UpfModels\Catalog();
        $catalog_base->model = 'EG110R';
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

        $catalog_base->description = 'Мини самосвал EG110R производства IHI массой 16.1 т.';


        $catalog_base->photos =
            json_encode(
                [ 0=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model1.jpg"]
                ]);

        $catalog_base->brand_id=9;
        $catalog_base->category_id=9;
        $catalog_base->comments_id=1;
        $catalog_base->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=1;
        $catalog_param->value=16100;
        $catalog_param->save();


        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=2;
        $catalog_param->value=11000;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=3;
        $catalog_param->value=6.87;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=4;
        $catalog_param->value=183.9;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=5;
        $catalog_param->value=800;
        $catalog_param->value=800;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=6;
        $catalog_param->value=10 ;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=7;
        $catalog_param->value=300 ;
        $catalog_param->save();


        /************************************************************ предложения */
        $catalog_rent = new \UpfModels\CatalogTech();

        $catalog_rent->name = 'Сдам в аренду Мини самосвал EG110R';
        $catalog_rent->price = '4000';

        /* update metadata */
        $meta_data = new \UpfModels\MetaData();
        $meta_data->title=$catalog_rent->name;
        $meta_data->description=$catalog_rent->name;
        $meta_data->keywords=$catalog_rent->name;

        $meta_data->alias = Mascame\Urlify::filter($catalog_rent->name);
        $meta_data->app_section = 'rent';
        $meta_data->save();

        $catalog_rent->metadata_id = $meta_data->id;
        /* end update metadata*/

        $catalog_rent->description ='Новый самосвал в отличном состоянии.';

        $catalog_rent->photos =
            json_encode([ 0=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model1.jpg"],
                1=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model1.jpg"]]);

        $catalog_rent->model_id=$catalog_base->id;
        $catalog_rent->admin_id=1;
        $catalog_rent->region_id=79;
        $catalog_rent->comments_id=4;
        $catalog_rent->status_id=1;
        $catalog_rent->opacity_id=1;
        $catalog_rent->active=true;
        $catalog_rent->save();




        $catalog_rent = new \UpfModels\CatalogTech();
        $catalog_rent->name = 'Сдам EG110R';
        $catalog_rent->price = '1000';

        /* update metadata */
        $meta_data = new \UpfModels\MetaData();
        $meta_data->title=$catalog_rent->name;
        $meta_data->description=$catalog_rent->name;
        $meta_data->keywords=$catalog_rent->name;

        $meta_data->alias = Mascame\Urlify::filter($catalog_rent->name);
        $meta_data->app_section = 'rent';
        $meta_data->save();

        $catalog_rent->metadata_id = $meta_data->id;
        /* end update metadata*/


        $catalog_rent->description ='Строительство качественных автомагистралей, областных и городских дорог не может выполняться без использования грейдеров. Грейдер предоставляет возможность эффективно и в кратчайшие сроки провести профилирование, разравнивание, перемещение грунта и других строительных материалов.';

        $catalog_rent->photos =
            json_encode([ 0=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model1.jpg"],
                1=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model1.jpg"],
                2=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model2.jpg"],
                3=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model2.jpg"],
                4=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model3.jpg"],
                5=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model3.jpg"]]);

        $catalog_rent->model_id=$catalog_base->id;
        $catalog_rent->admin_id=2;
        $catalog_rent->region_id=79;
        $catalog_rent->comments_id=4;

        $catalog_rent->status_id=1;
        $catalog_rent->opacity_id=2;
        $catalog_rent->active=true;
        $catalog_rent->save();

        /*************************************************************************************************************** модель 2*/
        $catalog_base = new \UpfModels\Catalog();
        $catalog_base->model = 'EG40R';
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

        $catalog_base->description = 'Думпер (мини-самосвал) IHI EG40R';

        $catalog_base->photos =
            json_encode(
                [ 0=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model2.jpg"]]);

        $catalog_base->brand_id=9;
        $catalog_base->category_id=9;
        $catalog_base->comments_id=1;
        $catalog_base->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=1;
        $catalog_param->value=6200;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=2;
        $catalog_param->value=4000;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=3;
        $catalog_param->value=2.51;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=4;
        $catalog_param->value=73.6;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=5;
        $catalog_param->value=500 ;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=6;
        $catalog_param->value=11 ;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=7;
        $catalog_param->value=100;
        $catalog_param->save();


        $catalog_rent = new \UpfModels\CatalogTech();
        $catalog_rent->name = 'Сдам EG40R';
        $catalog_rent->price = '1000';

        /* update metadata */
        $meta_data = new \UpfModels\MetaData();
        $meta_data->title=$catalog_rent->name;
        $meta_data->description=$catalog_rent->name;
        $meta_data->keywords=$catalog_rent->name;

        $meta_data->alias = Mascame\Urlify::filter($catalog_rent->name);
        $meta_data->app_section = 'rent';
        $meta_data->save();

        $catalog_rent->metadata_id = $meta_data->id;
        /* end update metadata*/


        $catalog_rent->description ='';

        $catalog_rent->photos =
            json_encode([ 0=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model1.jpg"],
                1=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model1.jpg"],
                2=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model2.jpg"],
                3=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model2.jpg"],
                4=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model3.jpg"],
                5=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model3.jpg"]]);

        $catalog_rent->model_id=$catalog_base->id;
        $catalog_rent->admin_id=2;
        $catalog_rent->region_id=79;
        $catalog_rent->comments_id=4;

        $catalog_rent->status_id=1;
        $catalog_rent->opacity_id=2;
        $catalog_rent->active=true;
        $catalog_rent->save();




        $catalog_rent = new \UpfModels\CatalogTech();
        $catalog_rent->name = 'EG40R';
        $catalog_rent->price = '1240';

        /* update metadata */
        $meta_data = new \UpfModels\MetaData();
        $meta_data->title=$catalog_rent->name;
        $meta_data->description=$catalog_rent->name;
        $meta_data->keywords=$catalog_rent->name;

        $meta_data->alias = Mascame\Urlify::filter($catalog_rent->name);
        $meta_data->app_section = 'rent';
        $meta_data->save();

        $catalog_rent->metadata_id = $meta_data->id;
        /* end update metadata*/


        $catalog_rent->description ='';

        $catalog_rent->photos =
            json_encode([ 0=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model2.jpg"],
                1=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model2.jpg"],
                2=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model3.jpg"],
                3=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model1.jpg"],
                4=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model2.jpg"],
                5=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model1.jpg"]]);

        $catalog_rent->model_id=$catalog_base->id;
        $catalog_rent->admin_id=2;
        $catalog_rent->region_id=79;
        $catalog_rent->comments_id=4;

        $catalog_rent->status_id=1;
        $catalog_rent->opacity_id=2;
        $catalog_rent->active=true;
        $catalog_rent->save();


        /*************************************************************************************************************** модель 3*/
        $catalog_base = new \UpfModels\Catalog();
        $catalog_base->model = 'EG70R';
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

        $catalog_base->description = 'Мини самосвал EG70R производства IHI массой 10.8 т.';


        $catalog_base->photos =
            json_encode(
                [ 0=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model3.jpg"]
                ]);

        $catalog_base->brand_id=9;
        $catalog_base->category_id=9;
        $catalog_base->comments_id=1;
        $catalog_base->save();


        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=1;
        $catalog_param->value=10800;
        $catalog_param->save();


        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=2;
        $catalog_param->value=6500;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=3;
        $catalog_param->value=3.76;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=4;
        $catalog_param->value=132.6;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=5;
        $catalog_param->value=700;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=6;
        $catalog_param->value=10;
        $catalog_param->save();

        $catalog_param = new \UpfModels\CatalogParamsValues();
        $catalog_param->model_id=$catalog_base->id;
        $catalog_param->param_id=7;
        $catalog_param->value=165;
        $catalog_param->save();


        $catalog_rent = new \UpfModels\CatalogTech();
        $catalog_rent->name = 'Сдаю думпер EG70R';
        $catalog_rent->price = '1240';

        /* update metadata */
        $meta_data = new \UpfModels\MetaData();
        $meta_data->title=$catalog_rent->name;
        $meta_data->description=$catalog_rent->name;
        $meta_data->keywords=$catalog_rent->name;

        $meta_data->alias = Mascame\Urlify::filter($catalog_rent->name);
        $meta_data->app_section = 'rent';
        $meta_data->save();

        $catalog_rent->metadata_id = $meta_data->id;
        /* end update metadata*/


        $catalog_rent->description ='';

        $catalog_rent->photos =
            json_encode([ 0=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model2.jpg"],
                1=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model2.jpg"],
                2=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model3.jpg"],
                3=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model1.jpg"],
                4=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model2.jpg"],
                5=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model1.jpg"]]);

        $catalog_rent->model_id=$catalog_base->id;
        $catalog_rent->admin_id=2;
        $catalog_rent->region_id=79;
        $catalog_rent->comments_id=4;

        $catalog_rent->status_id=1;
        $catalog_rent->opacity_id=3;
        $catalog_rent->active=true;
        $catalog_rent->save();


        $catalog_rent = new \UpfModels\CatalogTech();
        $catalog_rent->name = 'Думпер EG40R';
        $catalog_rent->price = '2300';

        /* update metadata */
        $meta_data = new \UpfModels\MetaData();
        $meta_data->title=$catalog_rent->name;
        $meta_data->description=$catalog_rent->name;
        $meta_data->keywords=$catalog_rent->name;

        $meta_data->alias = Mascame\Urlify::filter($catalog_rent->name);
        $meta_data->app_section = 'rent';
        $meta_data->save();

        $catalog_rent->metadata_id = $meta_data->id;
        /* end update metadata*/


        $catalog_rent->description ='';

        $catalog_rent->photos =
            json_encode([ 0=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model2.jpg"],
                1=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model2.jpg"],
                2=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model3.jpg"],
                3=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model1.jpg"],
                4=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model2.jpg"],
                5=>["name"=>"Big Japan Car","src"=>"/photo/techonline/catalog/model1.jpg"]]);

        $catalog_rent->model_id=$catalog_base->id;
        $catalog_rent->admin_id=2;
        $catalog_rent->region_id=79;
        $catalog_rent->comments_id=4;

        $catalog_rent->status_id=1;
        $catalog_rent->opacity_id=1;
        $catalog_rent->active=true;
        $catalog_rent->save();
	}

	public function down()
	{

	}
}
