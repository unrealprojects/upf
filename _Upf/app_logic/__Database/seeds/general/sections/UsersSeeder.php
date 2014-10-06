<?php
namespace UpfSeeds;
/*** Add Pages ***/
class UsersSeeder extends \Seeder {
    public function run()
    {
        $Faker = \Faker\Factory::create();

        /*** Add ***/
        for($i=0;$i<10;$i++){
            $Users = new \UpfModels\Users();

            /*** Content ***/
            $Users->title = $Faker->name;
            $Users->email = $Faker->email;
            $Users->phones = $Faker->phoneNumber;
            $Users->address = $Faker->address;
            $Users->website = $Faker->url;
            $Users->skype = $Users->title;
            $Users->about = $Faker->text;

            $Users->logotype = \Faker\Provider\Image::imageUrl(600+$i*10, 400+$i*5, 'business');


            /*** Meta ***/
            $Data = [
                /*** Content ***/
                'title' => $Users->title,
                'description' => $Users->title,
                'keywords' => $Users->title,
                /*** Relations ***/
                'section' => 'users',
                'category_id' => 0 ,
                'user_id' => 0 ,
                /*** Statuses ***/
                'status' => 1,
                'privileges' => 0,
                'rating' => 0,
                'favorite' => 0,
            ];

            $Users->meta_id = \UpfSeeds\MetaSeeder::AddMetaToSection($Data)[0];
            $Users->login = \UpfSeeds\MetaSeeder::AddMetaToSection($Data)[1];
            $Users->save();
        }
    }
}
