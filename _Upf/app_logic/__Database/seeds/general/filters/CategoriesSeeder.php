<?php
namespace UpfSeeds;
/*** Add Categories ***/
class CategoriesSeeder extends \Seeder {
	public function run()
	{
        $Categories = [
            "Мини-спецтехника",
            "Землеройная техника",
            "Подъемная техника",
            "Дорожная и уплотнительная техника",
            "Коммунальная техника",
            "Бетонное оборудование",
            "Коммерческий транспорт",
            "Складская техника"
        ];

        foreach($Categories as $Key=>$Category){
            $Model = new \UpfModels\Categories();
            $Model->title=$Category;
            $Model->section='catalog';
            $Model->parent_id = 0;
            $Model->alias = \Mascame\Urlify::filter($Model->title);
            $Model->logotype = '/photo/standard/categories/logo_' . $Key . '.jpg';
            $Model->status= 1 ;
            $Model->save();
        }

        $Categories = [
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

        foreach($Categories as $Key=>$Category){
            $Model = new \UpfModels\Categories();
            $Model->title=$Category;
            $Model->section='catalog';
            $Model->parent_id = 1;
            $Model->alias = \Mascame\Urlify::filter($Model->title);
            $Model->status = 1 ;
            $Model->privileges = 1;
            $Model->save();
        }

        $Categories = [
            "Автогрейдеры (грейдеры)",
            "Бульдозеры",
            "Буровые станки",
            "Гусеничные экскаваторы",
            "Земснаряды (землесосные снаряды)",
            "Кабелеукладчики",
            "Колесные экскаваторы",
            "Нестандартные экскаваторы",
            "Сваебойные установки",
            "Скреперы",
            "Траншейные экскаваторы",
            "Трубоукладчики",
            "Установки ГНБ",
            "Фронтальные мини-погрузчики",
            "Экскаваторы-планировщики",
            "Экскаваторы-погрузчики"
        ];

        foreach($Categories as $Key=>$Category){
            $Model = new \UpfModels\Categories();
            $Model->title=$Category;
            $Model->section='catalog';
            $Model->parent_id = 2;
            $Model->alias = \Mascame\Urlify::filter($Model->title);
            $Model->status = 1 ;
            $Model->save();
        }

        $Categories = [
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

        foreach($Categories as $Key=>$Category){
            $Model = new \UpfModels\Categories();
            $Model->title=$Category;
            $Model->section='catalog';
            $Model->parent_id = 3;
            $Model->alias = \Mascame\Urlify::filter($Model->title);
            $Model->status = 1 ;
            $Model->save();
        }

        $Categories = [
            "Асфальтоукладчики",
            "Битумощебнераспределители",
            "Бордюроукладчики",
            "Виброплиты (виброуплотнители)",
            "Вибротрамбовки",
            "Гудронаторы, автогудронаторы",
            "Дорожные катки",
            "Дорожные фрезы (фрезерные машины)",
            "Заливщики швов",
            "Машины для укладки тротуарной",
            "Машины для ямочного ремонта дорог",
            "Машины дорожной разметки",
            "Перегружатели асфальта",
            "Распределители вяжущего",
            "Ресайклеры (рециклеры)",
            "Укладчики сларри-сил",
            "Уширители обочин",
            "Швонарезчики (нарезчики швов)",
            "Щебнераспределители"
        ];

        foreach($Categories as $Key=>$Category){
            $Model = new \UpfModels\Categories();
            $Model->title=$Category;
            $Model->section='catalog';
            $Model->parent_id = 4;
            $Model->alias = \Mascame\Urlify::filter($Model->title);
            $Model->status = 1 ;
            $Model->save();
        }

        $Categories = [
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

        foreach($Categories as $Key=>$Category){
            $Model = new \UpfModels\Categories();
            $Model->title=$Category;
            $Model->section='catalog';
            $Model->parent_id = 5;
            $Model->alias = \Mascame\Urlify::filter($Model->title);
            $Model->status = 1 ;
            $Model->save();
        }

        $Categories = [
            "Автобетононасосы",
            "Автобетоносмесители",
            "Асфальтобетонные заводы (АБЗ)",
            "Бетонные заводы",
            "Бетонораздаточные стрелы",
            "Бетоноукладчики",
            "Виброрейки",
            "Глубинные вибраторы",
            "Затирочные машины по бетону",
            "Растворонасосы",
            "Растворосмесители",
            "Силосы для цемента",
            "Стационарные бетононасосы",
            "Стационарные бетоносмесители",
            "Торкрет-установки (шприц-машины)",
            "Штукатурные станции, машины"
        ];

        foreach($Categories as $Key=>$Category){
            $Model = new \UpfModels\Categories();
            $Model->title=$Category;
            $Model->section='catalog';
            $Model->parent_id = 6;
            $Model->alias = \Mascame\Urlify::filter($Model->title);
            $Model->status = 1 ;
            $Model->save();
        }

        $Categories = [
            "Грузовые автомобили",
            "Малый коммерческий транспорт",
            "Пассажирский транспорт",
            "Полуприцепы",
            "Прицепы",
            "Тягачи седельные"
        ];

        foreach($Categories as $Key=>$Category){
            $Model = new \UpfModels\Categories();
            $Model->title=$Category;
            $Model->section='catalog';
            $Model->parent_id = 7;
            $Model->alias = \Mascame\Urlify::filter($Model->title);
            $Model->status = 1 ;
            $Model->save();
        }

        $Categories = [
            "Вилочные погрузчики",
            "Подборщики заказов",
            "Подъемные столы (платформы)",
            "Ричстакеры",
            "Ричтраки",
            "Складские тележки",
            "Штабелеры",
            "Электротягачи (электрокары)"
        ];

        foreach($Categories as $Key=>$Category){
            $Model = new \UpfModels\Categories();
            $Model->title=$Category;
            $Model->section='catalog';
            $Model->parent_id = 8;
            $Model->alias = \Mascame\Urlify::filter($Model->title);
            $Model->status = 1 ;
            $Model->save();
        }
	}

}