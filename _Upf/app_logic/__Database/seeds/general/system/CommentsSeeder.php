<?php
namespace UpfSeeds;
use UpfModels;
/*** Add Comments ***/
class CommentsSeeder extends \Seeder {
	public function run()
	{
        // No Empty Comments Walls
	}

    static public function AddCommentsToSection($Section){
        $Faker = \Faker\Factory::create();
        /*** Get Max Wall Id***/
        $NewWall = \UpfModels\Comments::max('wall_id') + 1;

        /*** Add ***/
        for($i=0;$i<10;$i++){
            $Comments = new \UpfModels\Comments();

            /*** Content ***/
            $Comments->author = $Faker->name;
            $Comments->post = $Faker->paragraph();
            $Comments->alias = $Comments->CreateUniqueAlias(\Mascame\Urlify::filter(substr($Comments->post,0,20)),'\UpfModels\\Comments');
            /*** Relations ***/
            $Comments->section = $Section;
            $Comments->wall_id = $NewWall;

            $Comments->save();
        }
        return $NewWall;
    }

}
