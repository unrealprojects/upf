<?php
namespace UpfModels;

/*** Articles ***/
class Components extends Meta{
    public $timestamps = false;
    protected $table = 'system_components';
    public $Config = 'models/backend/sections/Components';


    /*** For Bread Crumbs ***/
    public function GetItemByAlias($Component){
        return $this->where('alias',$Component)->first();
    }

}