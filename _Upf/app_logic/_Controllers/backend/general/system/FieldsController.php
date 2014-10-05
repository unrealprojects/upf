<?php
namespace UpfControllers;

class FieldsController extends BackendController{
    public $View = '/backend/standard/layouts/section/';
    public $BaseUrl = '/backend/section/fields/';
    public $Model = '\UpfModels\Fields';

    /******************************************************************************************************************* Main Functionality ***/

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
        $Model = new $this->Model();
        if( \Input::get('title')){
            if($Location = $Model->AddItem()){
                echo json_encode(['message'=>'Запись успешно добавлена в базу данных.','type'=>'Success','location'=>$Location]);
            }else{
                echo json_encode(['message'=>'Невозможно добавить запись.','type'=>'Error']);
            }
        }else{
            $this->viewData['content'] = [
                'data'=>$Model->AddItemFields()
            ];
            return \View::make($this->View.'add',$this->viewData);
        }

    }

}
