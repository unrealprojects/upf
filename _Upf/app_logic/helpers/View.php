<?php
namespace UpfHelpers;

class View{
    /*** Relation To Array ***/
    static public function RelationToArray($Item,$Relations){
        $Relations = explode('-',$Relations);
    //        print_r($Item);exit;
        foreach($Relations as $Relation){
            $Item=$Item[$Relation];
        }

        return $Item;
    }
}