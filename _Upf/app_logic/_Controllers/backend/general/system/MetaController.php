<?php
namespace UpfControllers;

class MetaController extends GeneralBackendController{
    public $View = '/backend/standard/layouts/section/';
    public $BaseUrl = '/backend/section/articles/';

    public function __construct(){
       parent::__construct();
        $this->viewData['BaseUrl']=$this->BaseUrl;
    }


    /*** *** Main Functionality *** ***/////////////////////////////////////////////////////////////////////////////////

    /*** Show List ***/
    public function index(){

        $Articles = new $this->Model();
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
        $Articles = new $this->Model();
        $Articles->remove($alias);
    }

    /*** Add Item ***/
    public function add(){
        return \View::make($this->View.'add',$this->viewData);
    }


    /*** *** Default Easy Events *** ***/////////////////////////////////////////////////////////////////////////////////////

    /*** Trash Item ***/
    public function trash($alias){
        $Articles = new $this->Model();
        $Articles->ToTrash($alias);
    }

    /*** Draft Item ***/
    public function draft($alias){
        $Articles = new $this->Model();
        $Articles->ToDraft($alias);
    }

    /*** Active Item ***/
    public function active($alias){
        $Articles = new $this->Model();
        $Articles->ToActive($alias);
    }

    /*** Inactive Item ***/
    public function inactive($alias){
        $Articles = new $this->Model();
        $Articles->ToInactive($alias);
    }

    /*** To Favorite Item ***/
    public function toFavorite($alias){
        $Articles = new $this->Model();
        $Articles->ToFavorite($alias);
    }

    /*** From Favorite Item ***/
    public function fromFavorite($alias){
        $Articles = new $this->Model();
        $Articles->FromFavorite($alias);
    }
}
