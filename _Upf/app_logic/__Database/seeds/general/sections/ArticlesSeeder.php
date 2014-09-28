<?php
namespace UpfSeeds;
use UpfModels;
/*** Add Articles ***/
class ArticlesSeeder extends \Seeder {
	public function run()
	{
        $Faker = \Faker\Factory::create();

        /*** Add ***/
        for($i=0;$i<50;$i++){
            $Articles = new \UpfModels\Articles();

            /*** Content ***/
            $Articles->title = $Faker->name;
            $Articles->logotype = \Faker\Provider\Image::imageUrl(600+$i*10, 400+$i*5, 'nature');
            $Articles->intro = $Faker->paragraph();
            $Articles->text = $Faker->text();

            /*** Meta ***/
            $Data = [
                /*** Content ***/
                'title' => $Articles->title,
                'description' => $Articles->title,
                'keywords' => $Articles->title,
                /*** Relations ***/
                'section' => 'articles',
                'category_id' => 0 ,
                'user_id' => 0 ,
                /*** Statuses ***/
                'status' => 1,
                'privileges' => 0,
                'rating' => 0,
                'favorite' => 0,
            ];

            $Articles->meta_id = \UpfSeeds\MetaSeeder::AddMetaToSection($Data);

            $Articles->save();
        }
	}
}
