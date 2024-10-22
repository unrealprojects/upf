<?php
namespace UpfControllers;

class FieldsController extends SystemController{
    public $Upf_Page_Section = 'fields';

    public $BaseUrl = '/backend/section/fields/';
    public $Model = '\UpfModels\Fields';

    /******************************************************************************************************************* Main Functionality ***/

    /*** Show List ***/

        public function Index(){
            $Model = new $this->Model();

            // No Mater Status
            $this->Filters['status'] = 0;
            $this->ViewData['Content'] = $Model->Index($this->Filters,$this->HasMeta);


            return \View::make($this->View . 'List',$this->ViewData);
        }





    /*** Add Item ***/

        public function Add(){

            $Model = new $this->Model();

            if( \Input::get('title') || \Input::get('login') ){
                if($Location = $Model->AddItem($this->HasMeta)){
                    echo json_encode(['message'=>'Запись успешно добавлена в базу данных.','type'=>'Success','location'=>$Location]);
                }else{
                    echo json_encode(['message'=>'Невозможно добавить запись.','type'=>'Error']);
                }
            }else{
                $this->ViewData['Content'] = [ 'Fields' => $Model->GetFields('add') ];

                return \View::make($this->View.'Add',$this->ViewData);
            }
        }





    /*** Show Edit Element ***/

        public function Edit($Alias){

            $Model = new $this->Model();
            $this->ViewData['Content'] = $Model->EditItem($Alias, $this->HasMeta);

            return \View::make($this->View.'Edit',$this->ViewData);
        }





    /*** Update Item ***/

        public function Update($Alias){

            $Model = new $this->Model();
            if($Model->UpdateItem($Alias,$this->HasMeta)){
                echo json_encode([ 'message'=>'Запись успешно обновлена.','type'=>'Success']);
            }else{
                echo json_encode(['message'=>'Невозможно обновить запись.','type'=>'Error']);
            }
        }





    /*** Update Item Photos ***/

        public function UpdatePhotos($Alias){

            $Model = new $this->Model();

            if($Files = $Model->UpdateItemPhotos($Alias, $this->HasMeta)){
                echo json_encode(['message' => 'Запись успешно обновлена.','type'=>'Success','files'=>$Files]);
            }else{
                echo json_encode(['message' => 'Невозможно обновить запись.','type'=>'Error']);
            }
        }





    /*** Remove Item ***/
        public function Remove($Alias){

            $Model = new $this->Model();

            if($Model->remove($Alias, $this->HasMeta)){
                echo json_encode(['message'=>'Запись успешноудалена из базы данных.','type'=>'Success']);
            }else{
                echo json_encode(['message'=>'Невозможно удалить запись.','type'=>'Error']);
            }
        }





    /*** Remove Logotype ***/

        public function RemoveLogotype($Alias){

            $Model = new $this->Model();

            if($Model->RemoveLogotype($Alias, $this->HasMeta)){
                echo json_encode([ 'message'=>'Фото успешно обновлена.','type'=>'Success']);
            }else{
                echo json_encode(['message'=>'Невозможно удалить Фото.','type'=>'Error']);
            }
        }





    /*** Remove Photo ***/

        public function RemovePhotos($Alias,$Id){

            $Model = new $this->Model();

            if($Updated=$Model->RemovePhoto($Alias, $Id, $this->HasMeta)){
                echo json_encode([ 'message'=>'Фото успешно обновлена.','type'=>'Success']);
            }else{
                echo json_encode(['message'=>'Невозможно удалить Фото.','type'=>'Error']);
            }
        }




}
