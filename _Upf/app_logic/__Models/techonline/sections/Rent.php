<?php
namespace UpfModels;
/*** Rent ***/
class Rent extends Meta{
    public $timestamps = false;
    protected $table = 'section_rent';
    public $PhotosUrl = '/photo/standard/sections/rent/';
}























/*
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
          // Фильтр в Регионах
          ->whereHas('region', function($query) {
              if($this->filter['region']){
                  \UpfModels\CatalogRegion::filterSubRegions($query,$this->filter['region']);
              }
          })
    // Фильтр в Категориях
            ->whereHas('model', function($query) {
                if($this->filter['category']){
                    $query->whereHas('category',function($query){
                       \UpfModels\Categories::filterSubCategories($query,$this->filter['category']);
                    });
                }
            })
    // Фильтр по Поизводителям
            ->whereHas('model', function($query) {
                if($this->filter['brands']){
                    $query->whereHas('brand',function($query){
                        $query->whereIn('alias', $this->filter['brands']);
                    });
                }
            })
            // Фильтр по Параметрам
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
*/
