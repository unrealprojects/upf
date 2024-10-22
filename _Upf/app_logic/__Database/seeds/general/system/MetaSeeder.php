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
        $Meta->alias = $Meta->CreateUniqueAlias(\Mascame\Urlify::filter(isset($Data['title'])?$Data['title']:''),'\UpfModels\\Meta');

        /*** Content ***/
        $Meta->title = isset($Data['title'])?$Data['title']:'';
        $Meta->description = isset($Data['description'])?$Data['description']:'';
        $Meta->keywords = isset($Data['keywords'])?$Data['keywords']:'';

        /*** Filters ***/
        $Meta->category_id = isset($Data['category_id'])?$Data['category_id']:0;
        $Meta->region_id = isset($Data['region_id'])?$Data['region_id']:0;

        /*** Relations ***/
        $Meta->section = $Data['section'];
        //$Meta->comments_id = \UpfSeeds\CommentsSeeder::AddCommentsToSection($Data['section']);
        $Meta->comments_id = \UpfModels\Meta::max('comments_id') + 1;

        /*** Statuses ***/
        $Meta->status = isset($Data['status'])?$Data['status']:\Config::get('models/Fields.status.default');
        $Meta->privileges = isset($Data['privileges'])?$Data['privileges']:\Config::get('models/Fields.status.privileges');
        $Meta->rating = isset($Data['rating'])?$Data['rating']:0;
        $Meta->favorite = isset($Data['favorite'])?$Data['favorite']:0;


//        Todo :: Relation Tags
//        if(isset($Data->tags)){
//            $Meta->tags()->sync($Data->tags);
//        }

        if($Meta->save()){
            return [$Meta->id,$Meta->alias];
        }else{
            return false;
        }
    }
}
