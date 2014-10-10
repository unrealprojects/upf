<?php

namespace UpfModels;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Users extends Meta implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;
    public $timestamps = false;
	protected $table = 'section_users';
    public $Section = 'users';
	protected $hidden = array('password', 'remember_token');

    public $Config = 'models/backend/sections/Users';


    public function Register(){
        /*** Set Fields ***/

        $this->password = \Hash::make(\Input::get('password'));

        $this->login = $this->CreateUniqueAlias(\Mascame\Urlify::filter(\Input::get('login')),$this,'login');

        /*** Add Meta ***/
        $Data = [
            /*** Content ***/
            'title' => $this->login,
            'description' => $this->login,
            'keywords' => $this->login,
            /*** Relations ***/
            'section' => $this->Section,
            'category_id' => 0 ,
            'user_id' => 0 ,
            /*** Statuses ***/
            'status' => 1,
            'privileges' => 0,
            'rating' => 0,
            'favorite' => 0,
        ];

        $Meta = \UpfSeeds\MetaSeeder::AddMetaToSection($Data);

        $this->meta_id = $Meta[0];

        if($this->save()){
            return $this->login;
        }
    }




    /******************************************************************************************************************* Cabinet ***/

    public function CabinetItem($Alias){
        /*** Get Content Model***/
        $ContentModel=$this
            ->WhereAliasInMeta($this,$Alias)
            ->with(
                'meta',
                'meta.categories',
                'meta.categories.params',
                'meta.paramsvalues',
                'meta.tags',
                'meta.regions',
                'meta.files')
            ->first()
            ->toArray();
        // print_r($ContentModel);exit;

        /*** Result ***/
        return [
            'Item' => $ContentModel,
            'Fields' =>$this->GetFields('edit')
        ];
    }
}
