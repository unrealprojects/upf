<?php
namespace UpfSeeds;
/*** Add Tags ***/
class TagsSeeder extends \Seeder {
	public function run()
	{
        $Faker = \Faker\Factory::create();

        /*** Add ***/
        for($i=0;$i<30;$i++){
            $Tags = new \UpfModels\Tags();

            /*** Content ***/
            $Tags->title = $Faker->word();

            /*** Index ***/
            $Tags->alias = \UpfModels\General::CreateUniqueAlias(\Mascame\Urlify::filter($Tags->title),'\UpfModels\\Tags');

            /*** Relations ***/
            if($i<15){
                // For Articles
                $Tags->section = 'articles';
            }elseif($i<30){
                // For Pages
                $Tags->section = 'pages';
            }
            $Tags->save();
        }

        /*** Brands ***/
            $Brands = [
                'Mercedes-Benz',
                'MAN',
                'Foton',
                'Carmix',
                'Putzmeister',
                'Brinkmann',
                'Zettelmeyer',
                'Vicon',
                'IHI',
                'КамАЗ',
                'КрАЗ',
                'МТЗ',
                'УРБ',
                'Отечественные',
                'Иномарки',
            ];
        /*** Add ***/
        foreach($Brands as $Brand){
            $Tags = new \UpfModels\Tags();

            /*** Content ***/
            $Tags->title = $Brand;
            /*** Index ***/
            $Tags->alias = \UpfModels\General::CreateUniqueAlias(\Mascame\Urlify::filter($Brand),'\UpfModels\\Tags');
            $Tags->section = 'catalog';
            $Tags->save();
        }
	}
}
