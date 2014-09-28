<?php
namespace UpfSeeds;
use UpfModels;
/*** Add Relations :: Tags To Items ***/
class TagsToItemsSeeder extends \Seeder {
	public function run()
	{
        $Faker = \Faker\Factory::create();

        for($i=1;$i<30;$i++){
            for($j=0;$j<3;$j++){
                $TagsToItems = new \UpfModels\TagsToItems();

                /*** Index ***/
                    $TagsToItems->tag_id=$i;
                    $TagsToItems->item_id=$i+$j;

                /*** Relations ***/
                if(($i+$j)<15){
                    // For Articles
                    $TagsToItems->section = 'articles';
                }elseif(($i+$j)<30){
                    // For Pages
                    $TagsToItems->section = 'pages';
                }else{
                    $TagsToItems->section = null;
                }

                if($TagsToItems->section){
                    $TagsToItems->save();
                }
            }
        }
	}
}
