<?php

/**
 *  БАЗОВЫЙ КАТАЛОГ
 */
namespace UpfModels;

class Parts extends General {
    protected $table = 'system_parts';


    /* Связи */

    public function category()
    {
        return $this->hasOne('UpfModels\Categories','id','category_id');
    }

    public function comments()
    {
        return $this->hasMany('UpfModels\Comments','list_id','comments_id');
    }

    public function status()
    {
        return $this->hasOne('UpfModels\CatalogStatuses','id','status_id');
    }

    public function opacity()
    {
        return $this->hasOne('UpfModels\CatalogOpacity','id','opacity_id');
    }

    public function admin()
    {
        return $this->hasOne('UpfModels\CatalogAdmin','id','admin_id');
    }

    /* Запросы */
    public function getList($filter=[]){
        $this->filter = $filter;

        return $this->with('category','status','opacity','admin','admin.metadata','metadata')
            ->whereHas('category', function($query) {

            })
            ->paginate(5);
    }

    public function getListForSeller($seller){
        $this->filter['seller'] = $seller;
        return $this->with('category','status','opacity','admin','admin.metadata','metadata')
            ->whereHas('admin', function($query) {
                $query->whereHas('metadata',function($query){
                    $query->where('alias', $this->filter['seller']);
                });
            })
            ->paginate(5);
    }

    public function getElement($alias){
        $this->rewrite['alias']=$alias;
        return $this->with('category','status','opacity','admin','admin.metadata','comments','metadata')
            ->whereHas('metadata', function($query) {
                $query->where('alias',$this->rewrite['alias']);
            })
            ->first();
    }
}
