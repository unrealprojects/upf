<?php
namespace UpfControllers;

class MetaController extends GeneralBackendController{
    public $View = '/backend/standard/layouts/section/';
    public $BaseUrl = '/backend/section/articles/';
    public $Model = '\UpfModels\Meta';

    public function __construct(){
       parent::__construct();
        $this->viewData['BaseUrl']=$this->BaseUrl;
    }

    /*** *** Main Functionality *** ***/////////////////////////////////////////////////////////////////////////////////

    /*** Show List ***/
    public function index(){
        $Model = new $this->Model();
        // View Data
        $this->viewData['content'] = [
            'data'=>$Model->index()
        ];

        return \View::make($this->View.'list',$this->viewData);
    }

    /*** Show Edit Element ***/
    public function edit($alias){
        $Model = new $this->Model();
        $this->viewData['content'] = [
            'data'=>$Model->EditItem($alias)
        ];

        return \View::make($this->View.'edit',$this->viewData);
    }

    /*** Update Item ***/
    public function update($alias){
        $Input = \Input::all();

        $Model = new $this->Model();
        if($Updated=$Model->UpdateItem($alias,$Input)){
            echo json_encode([ 'message'=>'Запись успешно обновлена.','type'=>'Success']);
        }else{
            echo json_encode(['message'=>'Невозможно обновить запись.','type'=>'Error']);
        }
    }

    /*** Update Item Photos ***/
    public function updatePhotos($alias){
        $Input = \Input::all();

        $Model = new $this->Model();
        if($Files = $Model->UpdateItemPhotos($alias)){
            echo json_encode(['message' => 'Запись успешно обновлена.','type'=>'Success','files'=>$Files]);
        }else{
            echo json_encode(['message' => 'Невозможно обновить запись.','type'=>'Error']);
        }
    }


    /*** Remove Item ***/
    public function remove($alias){
        $Model = new $this->Model();
        if($Model->remove($alias)){
            echo json_encode(['message'=>'Запись успешноудалена из базы данных.','type'=>'Success']);
        }else{
            echo json_encode(['message'=>'Невозможно удалить запись.','type'=>'Error']);
        }
    }

    /*** Add Item ***/
    public function add(){
        return \View::make($this->View.'add',$this->viewData);
    }

    /*** *** Default Easy Events *** ***/////////////////////////////////////////////////////////////////////////////////////

    /*** Change Status ***/
    public function status($alias,$status){
        $Articles = new $this->Model();
        $Articles->ChangeStatus($alias,$status);
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
