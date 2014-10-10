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
            echo json_encode([
                'type'=>'Success'
            ]);
        }else{
            echo json_encode([
                'type'=>'Error',
                'message'=>'Доступ запрещен!'
            ]);
        }
    }

    /*** Auth LogOut ***/
    public function LogOut(){
        \Auth::users()->logout();
        return \Redirect::to('/');
    }


    /*** Auth Register ***/
    public function Register(){
        if(\Input::get('login') && \ Input::get('password')){
            $NewUser = new $this->Model();
            $NewUser->Register();
            echo $this->LogIn();
        }else{
            echo json_encode([
                'type'=>'Error',
                'message'=>'Ошибка регистрации!'
            ]);
        }
    }

}
