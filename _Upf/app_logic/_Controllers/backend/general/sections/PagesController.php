<?php
namespace UpfControllers;

class PagesController extends GeneralBackendController{
    public $View = '/backend/standard/layouts/section/';
    public $BaseUrl = '/backend/section/pages/';

    public function __construct(){
        parent::__construct();
        $this->viewData['BaseUrl']=$this->BaseUrl;
    }

    /*** Show List ***/
    public function index(){

        $Articles = new \UpfModels\Pages();
        // View Data
        $this->viewData['content'] = [
            'data'=>$Articles->index()
        ];

        return \View::make($this->View.'list',$this->viewData);
    }

    /*** Show Edit Element ***/
    public function edit($alias){

        return \View::make($this->View.'edit',$this->viewData);
    }

    /*** Update Item ***/
    public function update($alias){

    }

    /*** Remove Item ***/
    public function remove($alias){
        $Articles = new \UpfModels\Articles();
        $Articles->remove($alias);
    }

    /*** Add Item ***/
    public function add(){
        return \View::make($this->View.'add',$this->viewData);
    }

}
