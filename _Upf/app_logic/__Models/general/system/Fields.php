<?php

namespace UpfModels;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Fields extends General {
    public $timestamps = false;
	protected $table = 'system_fields';

    /*** Get All Field Indicated From View ***/
    public function GetFields($View){
        $Model =  new \UpfModels\Fields();
        return $Model
            ->where('destination',$this->destination)
            ->where('table',$this->table)
            ->where('view',$View)
            ->get();
    }

    public static function GetFieldValues($Values,$ValuesType){
        if($ValuesType=='model'){
            $Model = '\UpfModels\\' .$Values;
            $Model = new $Model();
            // Where section = ...
            return $Model->all();
        }elseif($ValuesType=='config'){
            return \Config::get($Values);
        }
    }
}
