<?php
namespace UpfControllers;

class HomeBackendController extends BackendController{
    public $View = '/backend/standard/layouts/system/';
    public function index(){
        return \View::make($this->View.'Home',$this->viewData);
    }
}
