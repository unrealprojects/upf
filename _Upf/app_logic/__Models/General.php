<?php

namespace UpfModels;

class General extends \Eloquent {
    public $Filter = [];
    public $Destination = 'backend';

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
    public static function CreateUniqueAlias($Alias,$Model,$AliasFiled = 'alias'){
        if($Model::where($AliasFiled,$Alias)->first()){
            $Alias = $Alias . '(Doubled)';
            return General::CreateUniqueAlias($Alias,$Model);
        }else{
            return $Alias;
        }
    }

    public static function isUniqueAlias($Alias,$Model,$AliasFiled='alias'){
        if($Model::where($AliasFiled,$Alias)->first()){
            return false;
        }else{
            return true;
        }
    }

}
