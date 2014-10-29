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
        foreach($Regions as $RegionKey => $Region){
            /*** Unset Level Countries ***/
            if($Region['administrative_unit'] == 0 ){
                unset($Regions[$RegionKey]);
            }
            /*** Set Level Areas ***/
            elseif($Region['administrative_unit'] == 1 && $Region['region_type'] == 0){
                $SortedRegions['areas']['list'][] = $Region;
                unset($Regions[$RegionKey]);
            }
            /*** Set Level Republics ***/
            elseif($Region['administrative_unit'] == 1 && $Region['region_type'] == 1){
                $SortedRegions['republics']['list'][] = $Region;
                unset($Regions[$RegionKey]);
            }
        }


        /*** Set Level Cities In Areas ***/
        // Each Area
        foreach($SortedRegions['areas']['list'] as $RegionKey => &$SortedRegion){

            //Each Region
            foreach($Regions as $RegionKey => $Region){
                if($SortedRegion['id']==$Region['parent_id']){
                    $SortedRegion['cities']['list'][] = $Region;
                    unset($Regions[$RegionKey]);
                }
            }
        }


        /*** Set Level Cities In Republics ***/
        // Each Area
        foreach($SortedRegions['republics']['list'] as &$SortedRegion){
            //Each Republic
            foreach($Regions as $RegionKey => $Region){
                if($SortedRegion['id']==$Region['parent_id']){
                    $SortedRegion['cities']['list'][] = $Region;
                    unset($Regions[$RegionKey]);
                }
            }
        }
        return $SortedRegions;
    }

}
