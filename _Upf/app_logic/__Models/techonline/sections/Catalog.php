<?php

/**
 *  БАЗОВЫЙ КАТАЛОГ
 */
namespace UpfModels;

class Catalog extends General {
    protected $table = 'section_catalog';

    public $filter;

    /* Связи */
    public function brand()
    {
        return $this->hasOne('UpfModels\CatalogBrand','id','brand_id');
    }

    public function category()
    {
        return $this->hasOne('UpfModels\Categories','id','category_id');
    }

    public function params_values()
    {
        return $this->hasMany('UpfModels\CatalogParamsValues','model_id','id');
    }

    /* Запросы */
    public function getList($filter){
       $this->filter = $filter;

       return $this->with('category','brand','params_values','params_values.paramData','metadata')
           /*** Фильтр в Категориях ***/
            ->whereHas('category', function($query) {
                 if($this->filter['category']){
                     \UpfModels\Categories::filterSubCategories($query,$this->filter['category']);
                 }
            })
           ->whereHas('brand', function($query) {
               if($this->filter['brands']){
                   $query->whereIn('alias', $this->filter['brands']);
               }
           })
           /*** Фильтр по Параметрам ***/
            ->whereHas('params_values',function($query){
                if($this->filter['params']){
                    foreach($this->filter['params'] as $ket => $param){
                        $query->where('param_id',$param['id'])
                            ->where('value','>=',$param['min-value'])
                            ->where('value','<=',$param['max-value']);
                    }
                }
            })
           ->orderBy('created_at','desc')
           ->paginate(5);
    }

    public function getElement($alias){
        $this->rewrite['alias']=$alias;
        return $this->with('category','brand','params_values','params_values.paramData','comments','metadata')
                    /* Уточнение app_section для категории */
                    ->whereHas('category', function($query) {
                        $query->where('app_section', 'catalog');
                    })                    /* Уточнение app_section для категории */
                    ->whereHas('category', function($query) {
                        $query->where('app_section', 'catalog');
                    })
                    ->whereHas('metadata', function($query) {
                        $query->where('alias',$this->rewrite['alias']);
                    })
                    ->first();
    }
}