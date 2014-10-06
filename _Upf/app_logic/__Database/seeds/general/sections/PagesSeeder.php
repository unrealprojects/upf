<?php
namespace UpfSeeds;
/*** Add Pages ***/
class PagesSeeder extends \Seeder {
    public function run()
    {
        $Faker = \Faker\Factory::create();

        /*** Add ***/
        for($i=0;$i<10;$i++){
            $Pages = new \UpfModels\Pages();

            /*** Content ***/
            $Pages->title = $Faker->name;
            $Pages->logotype = \Faker\Provider\Image::imageUrl(600+$i*10, 400+$i*5, 'nature');
            $Pages->intro = $Faker->paragraph();
            $Pages->text = $Faker->text();

            /*** Meta ***/
            $Data = [
                /*** Content ***/
                'title' => $Pages->title,
                'description' => $Pages->title,
                'keywords' => $Pages->title,
                /*** Relations ***/
                'section' => 'pages',
                'category_id' => 0 ,
                'user_id' => 0 ,
                /*** Statuses ***/
                'status' => 1,
                'privileges' => 0,
                'rating' => 0,
                'favorite' => 0,
            ];

            $Pages->meta_id = \UpfSeeds\MetaSeeder::AddMetaToSection($Data)[0];

            $Pages->save();
        }
    }
}
