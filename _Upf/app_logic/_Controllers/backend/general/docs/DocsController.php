<?php
namespace UpfControllers;

class DocsController extends GeneralBackendController{
    public $View = '/backend/standard/layouts/docs/';
    public $BaseUrl = '/backend/docs/';

    public function __construct(){
        parent::__construct();
        $this->viewData['BaseUrl']=$this->BaseUrl;
    }

    /*** Show Upf Cms ***/
    public function PageCms(){
        return \View::make($this->View.'Cms',$this->viewData);
    }

    /*** Show Css ***/
    public function PageCss(){
        return \View::make($this->View.'Css',$this->viewData);
    }
    /*** Show Js ***/
    public function PageJs(){
        return \View::make($this->View.'Js',$this->viewData);
    }
    /*** Show Test ***/
    public function PageTest(){
        return \View::make($this->View.'Test',$this->viewData);
    }
    /*** Show Test Backend ***/
    public function PageTestBackend(){
        return \View::make($this->View.'TestBackend',$this->viewData);
    }
    /*** Show Test Frontend***/
    public function PageTestFrontend(){
        return \View::make($this->View.'TestFrontend',$this->viewData);
    }
}
