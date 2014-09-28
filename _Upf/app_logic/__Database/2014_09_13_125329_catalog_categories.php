<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CatalogCategories extends Migration {

	public function up()
	{
        $categories = [
            "Мини-спецтехника",
            "Землеройная техника",
            "Подъемная техника",
            "Дорожная и уплотнительная техника",
            "Коммунальная техника",
            "Бетонное оборудование",
            "Коммерческий транспорт",
            "Складская техника"
        ];

        foreach($categories as $key=>$category){
            $catalog_category = new \UpfModels\Categories();
            $catalog_category->name=$category;
            $catalog_category->app_section='catalog';
            $catalog_category->parent_id=0;
            $catalog_category->alias = Mascame\Urlify::filter($catalog_category->name);
            $catalog_category->logo = '/photo/standard/categories/logo_' . $key . '.jpg';
            $catalog_category->active=true;
            $catalog_category->save();
        }

        $categories = [
            "Думперы (мини-самосвалы)",
            "Микро-техника",
            "Мини-бульдозеры",
            "Мини-погрузчики гусеничные",
            "Мини-погрузчики с бортовым поворотом",
            "Мини-погрузчики фронтальные",
            "Мини-экскаваторы гусеничные",
            "Мини-экскаваторы колесные",
            "Роботы для демонтажных работ",
            "Универсальная и нестандартная"
        ];

        foreach($categories as $category){
            $catalog_category = new \UpfModels\Categories();
            $catalog_category->name=$category;
            $catalog_category->app_section='catalog';
            $catalog_category->parent_id=1;
            $catalog_category->alias = Mascame\Urlify::filter($catalog_category->name);
            $catalog_category->active=true;
            $catalog_category->save();
        }
        $categories = [
            "Землеройная техника",
            "Автогрейдеры (грейдеры)",
            "Бульдозеры",
            "Буровые станки",
            "Гусеничные экскаваторы",
            "Земснаряды (землесосные снаряды)",
            "Кабелеукладчики",
            "Колесные экскаваторы",
            "Нестандартные экскаваторы",
            "Перегружатели",
            "Сваебойные установки",
            "Скреперы",
            "Траншейные экскаваторы",
            "Трубоукладчики",
            "Установки ГНБ",
            "Фронтальные мини-погрузчики",
            "Экскаваторы-планировщики",
            "Экскаваторы-погрузчики"
        ];

        foreach($categories as $category){
            $catalog_category = new \UpfModels\Categories();
            $catalog_category->name=$category;
            $catalog_category->parent_id=2;
            $catalog_category->app_section='catalog';
            $catalog_category->alias = Mascame\Urlify::filter($catalog_category->name);
            $catalog_category->popular=true;
            $catalog_category->active=true;
            $catalog_category->active=true;
            $catalog_category->save();
        }

        $categories = [
            "Подъемная техника",
            "Автокраны (автомобильные краны)",
            "Башенные краны",
            "Бурильно-крановые машины",
            "Внедорожные краны",
            "Гусеничные краны",
            "Козловые краны",
            "Кран на короткобазовом шасси",
            "Краны-манипуляторы (КМУ)",
            "Мини-краны",
            "Мобильные системы ремонта мостов",
            "Мостовые краны",
            "Перегружатели",
            "Подъемники и автовышки",
            "Самоходные краны",
            "Стационарные фасадные системы",
            "Судовые краны",
            "Телескопические погрузчики"
        ];

        foreach($categories as $category){
            $catalog_category = new \UpfModels\Categories();
            $catalog_category->name=$category;
            $catalog_category->parent_id=3;
            $catalog_category->app_section='catalog';
            $catalog_category->alias = Mascame\Urlify::filter($catalog_category->name);
            $catalog_category->active=true;
            $catalog_category->save();
        }

        $categories = [
            "Асфальтоукладчики",
            "Битумощебнераспределители",
            "Бордюроукладчики",
            "Виброплиты (виброуплотнители)",
            "Вибротрамбовки",
            "Гудронаторы, автогудронаторы",
            "Дорожные катки",
            "Дорожные фрезы (фрезерные машины)",
            "Заливщики швов",
            "Машины для укладки тротуарной …",
            "Машины для ямочного ремонта дорог",
            "Машины дорожной разметки",
            "Перегружатели асфальта (асфаль…",
            "Распределители вяжущего",
            "Ресайклеры (рециклеры), стабил…",
            "Укладчики сларри-сил",
            "Уширители обочин",
            "Швонарезчики (нарезчики швов)",
            "Щебнераспределители"
        ];

        foreach($categories as $category){
            $catalog_category = new \UpfModels\Categories();
            $catalog_category->name=$category;
            $catalog_category->parent_id=4;
            $catalog_category->app_section='catalog';
            $catalog_category->alias = Mascame\Urlify::filter($catalog_category->name);
            $catalog_category->active=true;
            $catalog_category->save();
        }

        $categories = [
            "Ассенизаторские машины (вакуум…",
            "Илососы (илососные машины)",
            "Каналопромывочные машины",
            "Комбинированные дорожные машины",
            "Комбинированные каналопромывоч…",
            "Мусоровозы",
            "Подметально-уборочные машины",
            "Поливомоечные машины",
            "Снегопогрузчики",
            "Снегоуборщики"
        ];

        foreach($categories as $category){
            $catalog_category = new \UpfModels\Categories();
            $catalog_category->name=$category;
            $catalog_category->app_section='catalog';
            $catalog_category->parent_id=5;
            $catalog_category->alias = Mascame\Urlify::filter($catalog_category->name);
            $catalog_category->active=true;
            $catalog_category->save();
        }

        $categories = [
            "Автобетононасосы",
            "Автобетоносмесители",
            "Асфальтобетонные заводы (АБЗ)",
            "Бетонные заводы",
            "Бетонораздаточные стрелы",
            "Бетоноукладчики",
            "Виброрейки",
            "Глубинные вибраторы",
            "Затирочные машины по бетону (з…",
            "Растворонасосы",
            "Растворосмесители",
            "Силосы для цемента",
            "Стационарные бетононасосы",
            "Стационарные бетоносмесители",
            "Торкрет-установки (шприц-машины)",
            "Штукатурные станции, машины"
        ];

        foreach($categories as $category){
            $catalog_category = new \UpfModels\Categories();
            $catalog_category->name=$category;
            $catalog_category->app_section='catalog';
            $catalog_category->parent_id=6;
            $catalog_category->alias = Mascame\Urlify::filter($catalog_category->name);
            $catalog_category->active=true;
            $catalog_category->save();
        }

        $categories = [
            "Грузовые автомобили",
            "Малый коммерческий транспорт",
            "Пассажирский транспорт",
            "Полуприцепы",
            "Прицепы",
            "Тягачи седельные"
        ];

        foreach($categories as $category){
            $catalog_category = new \UpfModels\Categories();
            $catalog_category->name=$category;
            $catalog_category->app_section='catalog';
            $catalog_category->parent_id=7;
            $catalog_category->alias = Mascame\Urlify::filter($catalog_category->name);
            $catalog_category->active=true;
            $catalog_category->save();
        }

        $categories = [
            "Вилочные погрузчики",
            "Подборщики заказов",
            "Подъемные столы (платформы)",
            "Ричстакеры",
            "Ричтраки",
            "Складские тележки",
            "Штабелеры",
            "Электротягачи (электрокары)"
        ];

        foreach($categories as $category){
            $catalog_category = new \UpfModels\Categories();
            $catalog_category->name=$category;
            $catalog_category->app_section='catalog';
            $catalog_category->parent_id=8;
            $catalog_category->alias = Mascame\Urlify::filter($catalog_category->name);
            $catalog_category->active=true;
            $catalog_category->save();
        }
	}

	public function down()
	{
	}

}
