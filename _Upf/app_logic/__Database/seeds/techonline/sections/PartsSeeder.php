<?php
namespace UpfSeeds;
use UpfModels;
/*** Add Parts ***/
class PartsSeeder extends \Seeder {

    public function run()
    {
        $Faker = \Faker\Factory::create();

        /*** Add ***/
        for($i=0;$i<20;$i++){
            $Parts = new \UpfModels\Parts();

            /*** Content ***/
            $Parts->title = $Faker->name;
            $Parts->logotype = \Faker\Provider\Image::imageUrl(600+$i*10, 400+$i*5, 'nature');
            $Parts->intro = $Faker->paragraph();
            $Parts->text = $Faker->text();
            $Parts->price = $Faker->numberBetween(200,10000);

            /*** Meta ***/
            $Data = [
                /*** Content ***/
                'title' => $Parts->title,
                'description' => $Parts->title,
                'keywords' => $Parts->title,
                /*** Relations ***/
                'section' => 'parts',
                'category_id' => 1,
                'user_id' => 0 ,
                /*** Statuses ***/
                'status' => 1,
                'privileges' => 0,
                'rating' => 0,
                'favorite' => 0,
            ];

            $Parts->meta_id = \UpfSeeds\MetaSeeder::AddMetaToSection($Data)[0];

            $Parts->save();
        }
    }
}
