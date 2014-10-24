<?php

namespace UpfModels;

class Voted extends General {
    public $timestamps = false;
    protected $table = 'system_voted';

    /*** Has Already Voted ***/
    static public function HasVoted($Section,$Item_id)
    {
        $instance = new static;
        if($instance::
               where('section',$Section)->
               where('item_id',$Item_id)->
               where('ip',\Request::getClientIp())->
               first()){
            return true;
        }else{
            return false;
        }
    }

    /*** Проголосовал ли пользователь ***/
    static public function Ban($Section,$Item_id)
    {
        $instance = new static;
        $instance->section=$Section;
        $instance->item_id=$Item_id;
        $instance->ip=\Request::getClientIp();
        $instance->save();
    }
}
