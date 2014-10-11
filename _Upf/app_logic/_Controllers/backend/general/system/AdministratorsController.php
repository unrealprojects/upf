<?php
namespace UpfControllers;

class AdministratorsController extends FieldsController{
    public $BaseUrl = '/backend/system/administrators/';
    public $Model = '\UpfModels\Administrators';

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
}
