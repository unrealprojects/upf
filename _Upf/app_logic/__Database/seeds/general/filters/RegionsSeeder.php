<?php
namespace UpfSeeds;
/*** Add Regions ***/
class RegionsSeeder extends \Seeder {
	public function run()
	{
        $RegionModel = new \UpfModels\Regions();
        $RegionModel->title="Россия";
        $RegionModel->administrative_unit=0;
        $RegionModel->parent_id=0;
        $RegionModel->status=1;
        $RegionModel->alias = \Mascame\Urlify::filter($RegionModel->title);
        $RegionModel->save();

        $Regions = [
            'Амурская обл.',
            'Архангельская обл.',
            'Астраханская обл',
            'Белгородская обл.',
            'Брянская обл. обл.',
            'Владимирская обл.',
            'Волгоградская обл.',
            'Вологодская обл.',
            'Воронежская обл.',
            'Ивановская обл.',
            'Калининградская обл.',
            'Калмыкия Калужская обл.',
            'Кировская обл.',
            'Костромская обл.',
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
            'Псковская обл.',
            'Ростовская обл.',
            'Рязанская обл.',
            'Самарская обл.',
            'Саратовская обл.',
            'Свердловская обл.',
            'Смоленская обл.',
            'Тамбовская обл',
            'Тверская обл.',
            'Тульская обл.',
            'Ульяновская обл.',
            'Челябинская обл.',
            'Ярославская обл.',
            'Алтайский край',
            'Забайкальский край',
            'Камчатский край',
            'Краснодарский край',
            'Красноярский край',
            'Пермский край',
            'Приморский край',
            'Хабаровский край'
        ];

        foreach($Regions as $Region){
            $RegionModel = new \UpfModels\Regions();
            $RegionModel->title=$Region;
            $RegionModel->administrative_unit=1;
            $RegionModel->region_type=0;

            $RegionModel->parent_id=1;

            $RegionModel->status=1;
            $RegionModel->alias = \Mascame\Urlify::filter($RegionModel->title);
            $RegionModel->save();
        }

        $Regions = [
            'Адыгея',
            'Алтай',
            'Башкортостан',
            'Бурятия',
            'Дагестан',
            'Ингушетия',
            'Кабардино-Балкария',
            'Калмыкия',
            'Карачаево-Черкесия',
            'Карелия',
            'Коми',
            'Крым',
            'Марий Эл',
            'Мордовия',
            'Саха (Якутия)',
            'Северная Осетия',
            'Татарстан',
            'Тыва (Тува)',
            'Удмуртия',
            'Хакасия',
            'Чечня',
            'Чувашия',
            'Ненецкий АО',
            'Ханты-Мансийский АО — Югра',
            'Чукотский АО',
            'Ямало-Ненецкий АО'
        ];

        foreach($Regions as $Region){
            $RegionModel = new \UpfModels\Regions();
            $RegionModel->title=$Region;
            $RegionModel->administrative_unit=2;
            $RegionModel->region_type=1;

            $RegionModel->parent_id=1;

            $RegionModel->status=1;
            $RegionModel->alias = \Mascame\Urlify::filter($RegionModel->title);
            $RegionModel->save();
        }


        $Regions = [
            'Благовещенск',
            'Белогорск',
            'Свободный',
            'Зея',
            'Райчихинск',
            'Шимановск'
        ];

        foreach($Regions as $Region){
            $RegionModel = new \UpfModels\Regions();
            $RegionModel->title=$Region;
            $RegionModel->administrative_unit=2;
            $RegionModel->region_type=0;

            $RegionModel->parent_id=2;

            $RegionModel->status=1;
            $RegionModel->alias = \Mascame\Urlify::filter($RegionModel->title);
            $RegionModel->save();
        }

        $Regions = [
            'Архангельск',
            'Северодвинск',
            'Котлас',
            'Новодвинск',
            'Коряжма',
            'Мирный'
        ];

        foreach($Regions as $Region){
            $RegionModel = new \UpfModels\Regions();
            $RegionModel->title=$Region;
            $RegionModel->administrative_unit=2;
            $RegionModel->region_type=0;

            $RegionModel->parent_id=3;

            $RegionModel->status=1;
            $RegionModel->alias = \Mascame\Urlify::filter($RegionModel->title);
            $RegionModel->save();
        }
	}
}
