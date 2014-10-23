<?php
namespace UpfControllers;

class HomeBackendController extends BackendController{
    public $View = '/backend/standard/layouts/system/';

    public function Index(){
        return \Redirect::to('/backend/section/catalog');
//        return \View::make($this->View.'Home',$this->ViewData);
    }
}
