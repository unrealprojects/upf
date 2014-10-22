<?php
namespace UpfSeeds;

/*** Add Catalog ***/
class CatalogSeeder extends \Seeder {
    public function run()
    {
        $Faker = \Faker\Factory::create();

        /*** Add ***/
        for($i=0;$i<30;$i++){
            $Catalog = new \UpfModels\Catalog();

            /*** Content ***/
            $Catalog->title = $Faker->name;
            $Catalog->logotype = \Faker\Provider\Image::imageUrl(600+$i*10, 400+$i*5, 'nature');
            $Catalog->intro = $Faker->paragraph();
            $Catalog->text = $Faker->text();

            /*** Meta ***/
            $Data = [
                /*** Content ***/
                'title' => $Catalog->title,
                'description' => $Catalog->title,
                'keywords' => $Catalog->title,
                /*** Relations ***/
                'section' => 'catalog',
                'category_id' => $i ,
                'user_id' => 0 ,
                /*** Statuses ***/
                'status' => 1,
                'privileges' => 0,
                'rating' => 0,
                'favorite' => 0,
            ];

            $Catalog->meta_id = \UpfSeeds\MetaSeeder::AddMetaToSection($Data)[0];

            $Catalog->save();
        }
    }
}


