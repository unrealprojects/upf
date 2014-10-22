<?php
namespace UpfSeeds;
use UpfModels;
/*** Add Rent* ***/
class RentSeeder extends \Seeder {

    public function run()
    {
        $Faker = \Faker\Factory::create();

        /*** Add ***/
        for($i=0;$i<20;$i++){
            $Rent = new \UpfModels\Rent();

            /*** Content ***/
            $Rent->title = $Faker->name;
            $Rent->logotype = \Faker\Provider\Image::imageUrl(600+$i*10, 400+$i*5, 'nature');
            $Rent->intro = $Faker->paragraph();
            $Rent->text = $Faker->text();
            $Rent->price = $Faker->numberBetween(200,10000);

            /*** Meta ***/
            $Data = [
                /*** Content ***/
                'title' => $Rent->title,
                'description' => $Rent->title,
                'keywords' => $Rent->title,
                /*** Relations ***/
                'section' => 'rent',
                'category_id' => $i ,
                'user_id' => $i ,
                'region_id' => $i ,
                /*** Statuses ***/
                'status' => 1,
                'privileges' => 0,
                'rating' => 0,
                'favorite' => 0,
            ];

            $Rent->meta_id = \UpfSeeds\MetaSeeder::AddMetaToSection($Data)[0];

            $Rent->save();
        }
    }
}
