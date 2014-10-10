<?php
namespace UpfFrontendControllers;

class UsersController extends FrontendController{
    public $Model = '\UpfModels\Users';
    public $BaseUrl = '/users/';

    /*** Auth LogIn ***/
    public function LogIn(){
        if (\Auth::users()->attempt(['login' => \Input::get('login'), 'password' => \Input::get('password')],
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
        \Auth::users()->logout();
        return \Redirect::to('/');
    }

    /*** Auth LogIn ***/
    public function Register(){
        if(\Input::get('login') && \ Input::get('password')){
            $NewUser = new $this->Model();
            $NewUser->Register();
            $this->login();
        }else{
            return [
                'type'=>'Error',
                'message'=>'Ошибка регистрации!'
            ];
        }

    }

}
