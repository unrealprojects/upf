<?php

namespace UpfModels;

class Categories extends Fields{
    protected $table = 'filter_categories';
    public $PhotosUrl = '/photo/standard/filters/params/';
    public $timestamps = true;

    /*** Relations ***/
    public function params(){
        return $this->belongsToMany('UpfModels\Params', 'filter_params_to_categories', 'category_id', 'param_id');
    }


    /*** Queries ***/
    public function GetFilters($category){
        return $this->with('filters')
            ->where('alias',$category)
            ->first();
    }


    /*** *** Subcategories in Double Level *** ***/

    static public function SortCategories($Popular = false){

       /*** Get Categories ***/
       $Instance = new static;
       $Categories=$Instance::where('section','catalog')->get()->toArray();

       $SortedCategories = [];
        $SortedCategories[0]['title'] = 'Популярные';
        $SortedCategories[0]['alias'] = '';
        /*** Get Popular ***/
        if($Popular){
            // Each Category
            foreach($Categories as &$Category){
                /*** Set Level Areas ***/
                if($Category['privileges']== true ){
                    $SortedCategories[0]['list'][] = $Category;
                }
            }
        }

        /*** Set  Categories ***/
        foreach($Categories as &$Category){
            /*** Set Level 1 Categories ***/
            if($Category['parent_id'] == 0 ){
                $SortedCategories[] = $Category;
                unset($Category);
            }
        }

        /*** Set Sub Categories ***/
        // Each Area
        foreach($SortedCategories as &$SortedCategory){
            //Each Region
            foreach($Categories as &$Category){

                if(isset($SortedCategory['id']) && $SortedCategory['id']==$Category['parent_id']){
                    $SortedCategory['list'][] = $Category;
                    unset($Category);

                }

            }
        }

//        print_r($SortedCategories);exit;
        return $SortedCategories;


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
