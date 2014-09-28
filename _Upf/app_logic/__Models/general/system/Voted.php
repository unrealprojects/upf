<?php

namespace UpfModels;

class Voted extends General {
    protected $table = 'system_voted';

    /*** Проголосовал ли пользователь ***/
    static public function hasVoted($app_section,$item_id){
        $instance = new static;
        if($instance::where('app_section',$app_section)->
               where('item_id',$item_id)->
               where('ip',\Request::getClientIp())->
               first()){
            return true;
        }else{
            return false;
        }
    }

}
