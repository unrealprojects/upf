<?php
namespace UpfControllers;

class DocsController extends BackendController{
    public $View = '/backend/standard/layouts/docs/';
    public $BaseUrl = '/backend/docs/';

    /*** Show Upf Cms ***/
    public function PageCms(){
        return \View::make($this->View.'Cms',$this->ViewData);
    }

    /*** Show Css ***/
    public function PageCss(){
        return \View::make($this->View.'Css',$this->ViewData);
    }
    /*** Show Js ***/
    public function PageJs(){
        return \View::make($this->View.'Js',$this->ViewData);
    }
    /*** Show Test ***/
    public function PageTest(){
        return \View::make($this->View.'Test',$this->ViewData);
    }
    /*** Show Test Backend ***/
    public function PageTestBackend(){
        return \View::make($this->View.'TestBackend',$this->ViewData);
    }
    /*** Show Test Frontend***/
    public function PageTestFrontend(){
        return \View::make($this->View.'TestFrontend',$this->ViewData);
    }
}
