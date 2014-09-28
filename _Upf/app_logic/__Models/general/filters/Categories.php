<?php

/**
 *  БАЗОВЫЙ КАТАЛОГ
 */
namespace UpfModels;

class Categories extends General{
    protected $table = 'filter_categories';

    /*** Relations ***/
    public function Filters(){
        return $this->belongsToMany('UpfModels\Params', 'params_to_categories', 'category_id', 'param_id');
    }

    /*** Queries ***/
    public function GetFilters($category){
        return $this->with('filters')
            ->where('alias',$category)
            ->first();
    }

    /*** Subcategories in Double Level***/
    static public function toSubCategories($withPopular=false){
       $instance = new static;
       $categories=$instance::where('app_section','catalog')->get()->toArray();
       $sorted=[];
        $i=0;
        // Popular
        if($withPopular){
            $sorted[0]=["name"=>"Популярные","alias"=>"popular"];
            foreach($categories as $key=>&$category){
                if($category['popular']){
                    $sorted[0]['subCategories'][]=$category;
                }
            }
            $i++;
        }

        // Catalog
       foreach($categories as $key=>&$category){
           if($category['parent_id']==0){
               $sorted[]=$category;
               foreach($categories as $subKey=>&$subcategory){
                   if($subcategory['parent_id']!=0 && $category['id']==$subcategory['parent_id']){
                       $sorted[$i]['subCategories'][]=$subcategory;
                       unset($categories[$subKey]);
                   }
               }
               unset($categories[$key]);
               $i++;
           }
       }
       return $sorted;
    }

    /*** Get Subcategories In Search ***/
    public static function filterSubCategories($query,$alias){

        $categories = new \UpfModels\Categories();
        $category = $categories->where('parent_id',0)->where('alias',$alias)->first();
        if($category){
            $parents = $categories->where('parent_id',$category->id)
                                  ->where('section', 'catalog')->get()->toArray();
            foreach($parents as $value){
                $keys[]=$value['id'];
            }
            $query->whereIn('id', $keys)->whereOr('alias', $alias);
        }else{
            $query->where('alias', $alias);
        }
    }
}
