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


    /*** Relations :: Rent :: Has Many ***/

    public function rent()
    {
        return $this->hasMany('UpfModels\Rent','user_id','id');
    }

    /*** Relations :: Parts :: Has Many ***/

    public function parts()
    {
        return $this->hasMany('UpfModels\Parts','user_id','id');
    }



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

    /*** *** Get Front List *** ***/

    public function FrontendIndex($Filter = []){

        /*** Get Data ***/
        $List = $this->WhereStatusesInMeta($this,$Filter)
            ->with('meta',
                'meta.categories',
                'meta.tags',
                'meta.regions',
                'meta.files'

            )
            ->paginate(
                isset($Filter['Pagination'])?$Filter['Pagination']
                    :\Config::get('site\app_settings.PaginateFrontend.content')
            );
       //  print_r($this->GetFields('list','frontend', true));exit;
        //print_r($List->toArray()['data']);exit;
//
        /*** Return Frontend Content ***/
        return [
            'List'          =>      $List->toArray()['data'],
            'Fields'        =>      $this->GetFields('list','frontend', true),
            'Pagination'    =>      $List->appends(\Input::except('page'))->links(),
            'Filters'       =>      $this->FrontFilters()
        ];
    }


    /*** *** Get Front Item *** ***/

    public function FrontendItem($Alias, $Meta = false, $SearchField = false, $Division = 'backend'){

        /*** Get Data ***/
        $Item = $this->WhereAliasInMeta($this,$Alias)
            ->with('meta',
                'meta.categories',
                'meta.tags',
                'meta.regions',
                'meta.files',
                'meta.comments',
                'rent',
                'rent.meta',
                'parts',
                'parts.meta'

            )
            ->first();

        // print_r($this->GetFields('list','frontend', true));exit;
//         print_r($Item->toArray());exit;

        /*** Return Frontend Content ***/
        return [
            'Item'          =>      $Item->toArray(),
            'Fields'        =>      $this->GetFields('list','frontend', true),
        ];
    }

}
