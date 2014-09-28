<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CatalogRegions extends Migration {

	public function up()
	{
        /*** РЕГИОНЫ ***/
        \Schema::create('catalog_region', function($table)
        {
            $table->increments('id');
            $table->string('alias')->nullable();
            $table->string('name')->nullable();

            $table->integer('parent_id')->default(0);
            $table->enum('type',array('Области','Республики','Автономные округа','Края'))->default('Области');

            $table->boolean('popular')->dafault(false);
            $table->boolean('active')->dafault(false);
        });

        $regions = [
            'Амурская обл.',
            'Архангельская обл.',
            'Астраханская обл',
            'Белгородская обл.',
            'Брянская обл. обл.',
            'Владимирская обл.',
            'Волгоградская обл.',
            'Вологодская обл.',
            'Владимирская обл.',
            'Воронежская обл.',
            'Ивановская обл.',
            'Кабардино-Балкария',
            'Калининградская обл.',
            'Калмыкия Калужская обл.',
            'Карачаево-Черкесия',
            'Кировская обл.',
            'Костромская обл.',
            'Краснодарский край',
            'Курганская обл.',
            'Курская обл.',
            'Ленинградская обл.',
            'Липецкая обл.',
            'Московская обл.',
            'Мурманская обл.',
            'Нижегородская обл.',
            'Новгородская обл.',
            'Оренбургская обл.',
            'Орловская обл.',
            'Пензенская обл.',
            'Пермский край',
            'Псковская обл.',
            'Ростовская обл.',
            'Рязанская обл.',
            'Самарская обл.',
            'Саратовская обл.',
            'Свердловская обл.',
            'Смоленская обл.',
            'Ставропольский край',
            'Тамбовская обл',
            'Тверская обл.',
            'Тульская обл.',
            'Ульяновская обл.',
            'Челябинская обл.',
            'Ярославская обл.'
        ];

        foreach($regions as $region){
            $catalog_region = new \UpfModels\CatalogRegion();
            $catalog_region->name=$region;
            $catalog_region->active=true;
            $catalog_region->alias = Mascame\Urlify::filter($catalog_region->name);
            $catalog_region->save();
        }

        $regions = [
            ['Адыгея',"Республики"],
            ['Алтай',"Республики"],
            ['Башкортостан',"Республики"],
            ['Бурятия',"Республики"],
            ['Дагестан',"Республики"],
            ['Ингушетия',"Республики"],
            ['Кабардино-Балкария',"Республики"],
            ['Калмыкия',"Республики"],
            ['Карачаево-Черкесия',"Республики"],
            ['Карелия',"Республики"],
            ['Коми',"Республики"],
            ['Крым',"Республики"],
            ['Марий Эл',"Республики"],
            ['Мордовия',"Республики"],
            ['Саха (Якутия)',"Республики"],
            ['Северная Осетия',"Республики"],
            ['Татарстан',"Республики"],
            ['Тыва (Тува)',"Республики"],
            ['Удмуртия',"Республики"],
            ['Хакасия',"Республики"],
            ['Чечня',"Республики"],
            ['Чувашия',"Республики"]
        ];

        foreach($regions as $region){
            $catalog_region = new \UpfModels\CatalogRegion();
            $catalog_region->name=$region[0];
            $catalog_region->type=$region[1];

            $catalog_region->active=true;
            $catalog_region->alias = Mascame\Urlify::filter($catalog_region->name);
            $catalog_region->save();
        }

        $regions = [
            ['Алтайский край','Края'],
            ['Забайкальский край','Края'],
            ['Камчатский край','Края'],
            ['Краснодарский край','Края'],
            ['Красноярский край','Края'],
            ['Пермский край','Края'],
            ['Приморский край','Края'],
            ['Хабаровский край', 'Края'],
        ];

        foreach($regions as $region){
            $catalog_region = new \UpfModels\CatalogRegion();
            $catalog_region->name=$region[0];
            $catalog_region->type=$region[1];
            $catalog_region->active=true;
            $catalog_region->alias = Mascame\Urlify::filter($catalog_region->name);
            $catalog_region->save();
        }

        $regions = [
            ['Ненецкий АО','Автономные округа'],
            ['Ханты-Мансийский АО — Югра','Автономные округа'],
            ['Чукотский АО','Автономные округа'],
            ['Ямало-Ненецкий АО','Автономные округа']
        ];
        foreach($regions as $region){
            $catalog_region = new \UpfModels\CatalogRegion();
            $catalog_region->name=$region[0];
            $catalog_region->type=$region[1];
            $catalog_region->active=true;
            $catalog_region->alias = Mascame\Urlify::filter($catalog_region->name);
            $catalog_region->save();
        }


        $regions = [
            'Благовещенск',
            'Белогорск',
            'Свободный',
            'Зея',
            'Райчихинск',
            'Шимановск'
        ];


        foreach($regions as $region){
            $catalog_region = new \UpfModels\CatalogRegion();
            $catalog_region->name=$region;
            $catalog_region->parent_id=1;
            $catalog_region->active=true;
            $catalog_region->alias = Mascame\Urlify::filter($catalog_region->name);
            $catalog_region->save();
        }

        $regions = [
            'Архангельск',
            'Северодвинск',
            'Котлас',
            'Новодвинск',
            'Коряжма',
            'Мирный'
        ];


        foreach($regions as $region){
            $catalog_region = new \UpfModels\CatalogRegion();
            $catalog_region->name=$region;
            $catalog_region->parent_id=2;
            $catalog_region->active=true;
            $catalog_region->popular=true;
            $catalog_region->alias = Mascame\Urlify::filter($catalog_region->name);
            $catalog_region->save();
        }
	}

	public function down()
	{
        \Schema::dropIfExists('catalog_region');
	}

}
