<?php

/**
 *  БАЗОВЫЙ КАТАЛОГ
 */
namespace UpfModels;

class CatalogRegion extends General {
    protected $table = 'catalog_region';

    /* Создание двухуровневых вложений */
    static public function toSubRegions($withPopular=false){

        $instance = new static;
        $regions['0']['subRegions']=$instance::where('popular',true)->get()->toArray();
        $regions['1']['subRegions']=$instance::where('type','Области')->get()->toArray();
        $regions['1']['name']='Области';
        $regions['1']['alias']='oblasty';
        $regions['2']['subRegions']=$instance::where('type','Республики')->get()->toArray();
        $regions['2']['name']='Республики';
        $regions['2']['alias']='republic';
      //  $regions['3']['subRegions']=$instance::where('type','Автономные округа')->get()->toArray();
      //  $regions['3']['name']='Автономные округа';
       // $regions['3']['alias']='okrug';
     //   $regions['4']['subRegions']=$instance::where('type','Края')->get()->toArray();
     //   $regions['4']['name']='Края';
     //   $regions['4']['alias']='cray';

        $sorted=[];
        $i=0;

        /* Формирование категории Популярные */
        if($withPopular){
            $sorted[0]=["name"=>"Популярные","alias"=>"popular"];
            foreach($regions[0]['subRegions'] as $key=>&$region){
                if($region['popular']){
                    $sorted[0]['subRegions'][]=$region;
                }
            }
        }

        /* Формирование регионов и городов */
        for($region_id=1;$region_id<=2;$region_id++){
            $sorted[$region_id]['name']=$regions[$region_id]['name'];
            $sorted[$region_id]['alias']=$regions[$region_id]['alias'];
            foreach($regions[$region_id]['subRegions'] as $key=>$region){
                if($region['parent_id']==0){
                    $sorted[$region_id]['subRegions'][]=$region;
                    foreach($regions[$region_id]['subRegions'] as $subKey=>&$subregion){
                        if($subregion['parent_id']!=0 && $region['id']==$subregion['parent_id']){
                            $sorted[$region_id]['subRegions'][$i]['cities'][]=$subregion;
                            unset($regions[$region_id][$subKey]);
                        }
                    }
                    unset($regions[$region_id][$key]);
                    $i++;
                }
            }
        }
        return $sorted;
    }

    /*** Фильтр :: Получение вложенных категорий при поиске ***/
    public static function filterSubRegions($query,$alias){
        $regions = new \UpfModels\CatalogRegion();
        $region = $regions->where('parent_id',0)->where('alias',$alias)->first();

        if($region){
            $parents = $regions->where('parent_id',$region->id)->get()->toArray();
            foreach($parents as $value){
                $keys[]=$value['id'];
            }
            $query->whereIn('id', $keys)->whereOr('alias', $alias);
        }else{
            $query->where('alias', $alias);
        }
    }
}
