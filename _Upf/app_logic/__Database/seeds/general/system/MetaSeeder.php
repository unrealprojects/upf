<?php
namespace UpfSeeds;
/*** Add Meta Default***/
class MetaSeeder extends \Seeder {
	public function run()
	{

	}

    /*** Add Section Meta (['title','section'])***/
    public static function AddMetaToSection($Data){
        if(empty($Data['title']) || empty($Data['section'])){
            return false;
        }
        $Meta = new \UpfModels\Meta();

        /*** Index ***/
        $Meta->alias = \Mascame\Urlify::filter(isset($Data['title'])?$Data['title']:'');

        /*** Content ***/
        $Meta->title = isset($Data['title'])?$Data['title']:'';
        $Meta->description = isset($Data['description'])?$Data['description']:'';
        $Meta->keywords = isset($Data['keywords'])?$Data['keywords']:'';

        /*** Filters ***/
        $Meta->category_id = isset($Data['category_id'])?$Data['category_id']:0;
        $Meta->region_id = isset($Data['region_id'])?$Data['region_id']:0;

        /*** Relations ***/
        $Meta->section = $Data['section'];
        $Meta->user_id = isset($Data['user_id'])?$Data['user_id']:0;
        $Meta->comments_id = \UpfSeeds\CommentsSeeder::AddCommentsToSection($Data['section']);

        /*** Statuses ***/
        $Meta->status = isset($Data['status'])?$Data['status']:\Config::get('models/Fields.status.default');
        $Meta->privileges = isset($Data['privileges'])?$Data['privileges']:\Config::get('models/Fields.status.privileges');
        $Meta->rating = isset($Data['rating'])?$Data['rating']:0;
        $Meta->favorite = isset($Data['favorite'])?$Data['favorite']:0;

        if($Meta->save()){
            return $Meta->id;
        }else{
            return false;
        }
    }
}
