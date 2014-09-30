<?php
namespace UpfControllers;

class AdministratorsController extends GeneralBackendController{
    public $View = '/backend/standard/layouts/section/';
    public $BaseUrl = '/backend/section/administrators/';

    public function __construct(){
       parent::__construct();
        $this->viewData['BaseUrl']=$this->BaseUrl;
    }

    public function Auth(){
        if(\Input::get('login') && \Input::get('password')){

        }else{
            return \View::make('/backend/standard/layouts/system/auth',$this->viewData);
        }
    }
}
