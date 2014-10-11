<?php
namespace UpfControllers;

class HomeBackendController extends BackendController{
    public $View = '/backend/standard/layouts/system/';

    public function Index(){
        return \View::make($this->View.'Home',$this->ViewData);
    }
}
