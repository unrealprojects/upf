<?php
namespace UpfControllers;

class AdministratorsController extends GeneralBackendController{
    public $View = '/backend/standard/layouts/section/';
    public $BaseUrl = '/backend/section/administrators/';
    public $Model = '\UpfModels\Administrators';

    public function __construct(){
       parent::__construct();
        $this->viewData['BaseUrl']=$this->BaseUrl;
    }
    /*** Auth Form***/
    public function Auth(){
        return \View::make('/backend/standard/layouts/system/auth',$this->viewData);
    }

    /*** Auth Login ***/
    public function LogIn(){
        if (\Auth::attempt(['login' => \Input::get('login'), 'password' => \Input::get('password')],
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

    public function LogOut(){
        \Auth::logout();
        return \Redirect::to('/');
    }

    public function ForgotPassword(){

    }
}
