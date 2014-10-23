<?php
namespace UpfControllers;

class AdministratorsController extends FieldsController{
    public $Upf_Page_Section = 'administrators';

    public $BaseUrl = '/backend/system/administrators/';
    public $Model = '\UpfModels\Administrators';
    public $HasMeta = false;

    /*** Auth Form***/
    public function Auth(){
        if(!\Auth::administrators()->check()){
            return \View::make('/backend/standard/layouts/system/Auth',$this->ViewData);
        }else{
            return \Redirect::to('/backend');
        }
    }

    /*** Auth LogIn ***/
    public function LogIn(){
        if (\Auth::administrators()->attempt(['login' => \Input::get('login'), 'password' => \Input::get('password')],
            \Input::get('remember')?true:false)
        ) {
            return [
                    'type'=>'Success'
                ];
        }else{
            return [
                'type'=>'Error',
                'message'=>'Доступ запрещен!'
            ];
        }
    }
    /*** Auth LogOut ***/
    public function LogOut(){
        \Auth::administrators()->logout();
        return \Redirect::to('/');
    }

    public function ForgotPassword(){


    }





    /*** Show Edit Element ***/

    public function Edit($Alias){

        $Model = new $this->Model();
        $this->ViewData['Content'] = $Model->EditItem($Alias, $this->HasMeta,'login');

        return \View::make($this->View.'edit',$this->ViewData);
    }


    /*** Update Item ***/

    public function Update($Alias){

        $Model = new $this->Model();
        if($Model->UpdateItem($Alias,$this->HasMeta,'login')){
            echo json_encode([ 'message'=>'Запись успешно обновлена.','type'=>'Success']);
        }else{
            echo json_encode(['message'=>'Невозможно обновить запись.','type'=>'Error']);
        }
    }

    /*** Remove Item ***/
    public function Remove($Alias){

        $Model = new $this->Model();

        if($Model->remove($Alias, $this->HasMeta,'login')){
            echo json_encode(['message'=>'Запись успешноудалена из базы данных.','type'=>'Success']);
        }else{
            echo json_encode(['message'=>'Невозможно удалить запись.','type'=>'Error']);
        }
    }


}
