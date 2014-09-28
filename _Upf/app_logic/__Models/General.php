<?php

namespace UpfModels;

class General extends \Eloquent {
    public $Filter = [];

    /*** Relation Meta ***/
    public function Meta()
    {
        return $this->hasOne('UpfModels\Meta','id','meta_id');

    }

    /*** Relation Comments ***/
    public function Comments()
    {
        return $this->hasMany('UpfModels\Comments','wall_id','comments_id');
    }


    /*** Create Unique Alias ***/
    public static function CreateUniqueAlias($Alias,$Model){
        if($Model::where('alias',$Alias)->first()){
            $Alias = $Alias . '(Doubled)';
            return General::CreateUniqueAlias($Alias,$Model);
        }else{
            return $Alias;
        }
    }

    public static function isUniqueAlias($Alias,$Model){
        if($Model::where('alias',$Alias)->first()){
            return false;
        }else{
            return true;
        }
    }

}
