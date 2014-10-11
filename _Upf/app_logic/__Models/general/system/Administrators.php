<?php

namespace UpfModels;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Administrators extends Fields implements UserInterface, RemindableInterface{
    use UserTrait, RemindableTrait;
    protected $table = 'system_administrators';
    public $Config = 'models/backend/system/Administrators';
    public $timestamps = true;


    public function Auth(){
        $Result = $this->where('password',\Hash::make(\Input::get('password')))
             ->where('login',\Input::get('password'))
             ->first();
        if($Result){
            echo '111';
        }else{
            echo '000';
        }
    }

//    /*** Edit Item ***/
//    public function EditItem($Login){
//        /*** Get Content Model***/
//        $ContentModel=$this
//            ->where('login',$Login)
//            ->first();
//        /*** Result ***/
//        return [
//            'item' => $ContentModel->toArray(),
//            'fields' =>$this->GetFields('edit')
//        ];
//    }

}