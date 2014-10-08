<?php

namespace UpfModels;
/*** Params ***/
class Params extends Fields {
    protected $table = 'filter_params';
    public $PhotosUrl = '/photo/standard/filters/params/';
    public $timestamps = true;

    /***  Tags :: Many To Many ***/
    public function categories()
    {
        return $this->belongsToMany('UpfModels\Categories', 'filter_params_to_categories', 'param_id', 'category_id');
    }

    /*** Edit Item ***/
    public function EditItem($Alias){
        /*** Get Content Model***/
        $ContentModel=$this
            ->where('alias',$Alias)
            ->with('categories')
            ->first()->toArray();

        /*** Result ***/
        return [
            'item' => $ContentModel,
            'fields' =>$this->GetFields('edit')
        ];
    }
}
