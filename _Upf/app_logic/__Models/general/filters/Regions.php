<?php

/**
 *  БАЗОВЫЙ КАТАЛОГ
 */
namespace UpfModels;

class Regions extends Fields {
    protected $table = 'filter_regions';
    public $PhotosUrl = '/photo/standard/filters/regions/';
    public $timestamps = true;




    /*** *** Sort Regions *** ***/

    static public function SortRegions($Popular = false){

        /*** Get Regions ***/
        $Instance = new static;
        $Regions = $Instance::all()->toArray();


        /*** Sort Regions***/
        $SortedRegions = [
            'popular' => ['title'=>'Популярные','list' => []],
            'areas' => ['title'=>'Области','list' => []],
            'republics' => ['title'=>'Республики','list' => []],
        ];


        /*** Get Popular ***/
        if($Popular){
            // Each Region
            foreach($Regions as &$Region){
                /*** Set Level Areas ***/
                if($Region['privileges']== true ){
                    $SortedRegions['popular']['list'][] = $Region;
                }
            }
        }


        /*** Set Level Areas ***/
        foreach($Regions as &$Region){
            /*** Unset Level Countries ***/
            if($Region['administrative_unit']== 0 ){
                unset($Region);
            }
            /*** Set Level Areas ***/
            elseif($Region['administrative_unit']== 1 && $Region['region_type']== 0){
                $SortedRegions['areas']['list'][] = $Region;
                unset($Region);
            }
            elseif($Region['administrative_unit']== 1 && $Region['region_type']== 1){
                $SortedRegions['republics']['list'][] = $Region;
                unset($Region);
            }
        }

        /*** Set Level Cities In Areas ***/
        // Each Area
        foreach($SortedRegions['areas']['list'] as $SortedRegion){
            //Each Region
            foreach($Regions as &$Region){
                if($SortedRegion['id']==$Region['parent_id']){
                    $SortedRegion['cities']['list'][] = $Region;
                    unset($Region);
                }
            }
        }

        /*** Set Level Cities In Republics ***/
        // Each Area
        foreach($SortedRegions['republics']['list'] as $SortedRegion){
            //Each Republic
            if($SortedRegion['id']==$Region['parent_id']){
                $SortedRegion['cities']['list'][] = $Region;
                unset($Region);
            }
        }
       // print_r($SortedRegions);exit;

        return $SortedRegions;

    }





    /*** *** Search In "SubRegions" *** ***/

    public static function filterSubRegions($Query,$Alias){

        /*** Get Current Region ***/
        $Regions = new \UpfModels\Regions();
        $Region = $Regions->where('parent_id',0)->where('alias',$Alias)->first();

        /*** Search In Parents ***/
        if($Region){
            $Parents = $Regions->where('parent_id',$Region->id)->get()->toArray();

            // Each Parent
            foreach($Parents as $Parent){
                $Keys[]=$Parent['id'];
            }
            $Query->whereIn('id', $Keys)->whereOr('alias', $Alias);
        }else{
            $Query->where('alias', $Alias);
        }

    }

}
