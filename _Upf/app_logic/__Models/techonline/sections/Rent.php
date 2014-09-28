<?php

/**
 *  БАЗОВЫЙ КАТАЛОГ
 */
namespace UpfModels;

class Rent extends General {
    protected $table = 'system_rent';


    /* Связи */
    public function model(){
        return $this->hasOne('UpfModels\Catalog','id','model_id');
    }

    public function region(){
        return $this->hasOne('UpfModels\CatalogRegion','id','region_id');
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
    public function getList($filter){
        $this->filter = $filter;

      $query = $this::with('model',
                           'model.category',
                           'model.brand',
                           'model.metadata',
                           'model.params_values',
                           'model.params_values.paramData',
                           'region',
                           'status',
                           'opacity',
                           'admin',
                           'admin.metadata',
                           'metadata')
          /*** Фильтр в Регионах ***/
          ->whereHas('region', function($query) {
              if($this->filter['region']){
                  \UpfModels\CatalogRegion::filterSubRegions($query,$this->filter['region']);
              }
          })
            /*** Фильтр в Категориях ***/
            ->whereHas('model', function($query) {
                if($this->filter['category']){
                    $query->whereHas('category',function($query){
                       \UpfModels\Categories::filterSubCategories($query,$this->filter['category']);
                    });
                }
            })
            /*** Фильтр по Поизводителям ***/
            ->whereHas('model', function($query) {
                if($this->filter['brands']){
                    $query->whereHas('brand',function($query){
                        $query->whereIn('alias', $this->filter['brands']);
                    });
                }
            })
            /*** Фильтр по Параметрам ***/
            ->whereHas('model', function($query) {
                if($this->filter['params']){
                    foreach($this->filter['params'] as $this->filter['key'] => $this->filter['param']){
                        $query->whereHas('params_values',function($query){
                            $query->where('param_id',$this->filter['param']['id'])
                                ->where('value','>=',$this->filter['param']['min-value'])
                                ->where('value','<=',$this->filter['param']['max-value']);
                        });
                    }
                }
            })
            ->orderBy('status_id','desc')
            ->orderBy('created_at','desk');

    if($this->filter['price-max'] && $this->filter['price-min']){
        $query = $query->where('price','>=',$this->filter['price-min'])
                 ->where('price','<=',$this->filter['price-max']);
    }

    return $query->paginate(5);


    }

    public function getElement($alias){
        $this->rewrite['alias']=$alias;
        return $this::with('model',
            'model.category',
            'model.brand',
            'model.metadata',
            'model.params_values',
            'model.params_values.paramData',
            'region',
            'comments',
            'status',
            'opacity',
            'admin',
            'admin.metadata',
            'metadata')
            ->whereHas('metadata', function($query) {
                $query->where('alias',$this->rewrite['alias']);
            })
            ->first();
    }
}
