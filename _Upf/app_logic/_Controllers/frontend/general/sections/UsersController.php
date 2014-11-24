<?php
namespace UpfFrontendControllers;

class UsersController extends SectionsController{
    public $Upf_Page_Section =       'users';

    public $Model =                  '\UpfModels\Users';
    public $BaseUrl =                '/users/';

    public function __construct(){
        parent::__construct();

        // Set Filters
        $this->ViewData['HasFilters'] = [
            'Categories' => false,
            'Regions' =>    true,
            'Tags' =>       false,
            'Params' =>     false,
            'price' =>      false,
            'TabsNode'=>     'Node-XXS-12 Node-XS-12'
        ];

    }

    /*** Auth LogIn ***/
    public function LogIn($Login = false){
        if(!$Login){
            $Login = \Input::get('login');
        }
        if (\Auth::users()->attempt(['login' => $Login, 'password' => \Input::get('password')],
            \Input::get('remember')?true:false)
        ) {
            echo json_encode([
                'type'=>'Success'
            ]);
        }else{
            echo json_encode([
                'type'=>'Error',
                'message'=>'Невериный логин или пароль!'
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
        // Send Register Mail
        $Data = [
            'Login' => \Input::get('login'),
            'Password' => \Input::get('password')
        ];
        if(\Input::get('login') && \Input::get('password')){
            $NewUser = new $this->Model();

            if($Login = $NewUser->Register()){

                \Mail::send('emails.Welcome', $Data, function($Message) use ($Data)
                {
                    $Message->from('info@techonline.com', 'стройтехника');
                    $Message->to($Data['Login'], $Data['Login'])->subject('Регистрация на сайте стройтехника.онлайн');
                });

                echo $this->LogIn($Login);
            }else{
                echo json_encode([
                    'type'=>'Error',
                    'message'=>'Вы уже зарегестрированы на сайте!'
                ]);
            }


        }else{
            echo json_encode([
                'type'=>'Error',
                'message'=>'Ошибка регистрации!'
            ]);
        }
    }

}
