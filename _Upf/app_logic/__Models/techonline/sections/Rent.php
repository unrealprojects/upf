<?php
namespace UpfModels;
/*** Rent ***/
class Rent extends Meta{
    public $timestamps = false;
    protected $table = 'section_rent';
    public $Section = 'rent';
    public $PhotosUrl = '/photo/standard/sections/rent/';


    /*** Categories :: Has One ***/

    public function catalog()
    {
        return $this->hasOne('UpfModels\Catalog','id','model_id');
    }



    /******************************************************************************************************************* ***/
    /******************************************************************************************************************* ***/

    /*** ***    Front Functions     *** ***/

    /******************************************************************************************************************* ***/
    /******************************************************************************************************************* ***/




    /*** *** Get Front List *** ***/

    public function FrontendIndex($Filter = []){

        /*** Get Data ***/
        $List = $this->WhereStatusesInMeta($this,$Filter)

            ->with('meta',
                'meta.categories',
                'meta.tags',
                'meta.regions',
                'meta.files',
                'users',
                'users.meta',
                'meta.comments',
                'catalog',
                'catalog.meta',
                'catalog.meta.categories',
                'catalog.meta.tags',
                'catalog.meta.categories.params',
                'catalog.meta.paramsvalues',
                'catalog.meta.paramsvalues.paramData'

            )

            //  Hard Crutch
            ->leftJoin('system_meta', 'meta_id', '=', 'system_meta.id')
            ->orderBy('created_at', 'DESC')
            ->select($this->table . '.*')


            ->paginate(
                isset($Filter['Pagination'])?$Filter['Pagination']
                    :\Config::get('site\app_settings.PaginateFrontend.content')
            );


//         print_r($this->GetFields('list','frontend', true));exit;
//        print_r($List->toArray()['data']);exit;
//
        /*** Return Frontend Content ***/
        return [
            'List'          =>      $List->toArray()['data'],
            'Fields'        =>      $this->GetFields('list','frontend', true),
            'Pagination'    =>      $List->appends(\Input::except('page'))->links(),
            'Filters'       =>      $this->Filters()
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
                'users',
                'users.meta',
                'catalog',
                'catalog.meta',
                'catalog.meta.categories',
                'catalog.meta.tags',
                'catalog.meta.categories.params',
                'catalog.meta.paramsvalues',
                'catalog.meta.paramsvalues.paramData'
            )
            ->first();

        // print_r($this->GetFields('list','frontend', true));exit;
        // print_r($Item->toArray());exit;

        /*** Return Frontend Content ***/
        return [
            'Item'          =>      $Item->toArray(),
            'Fields'        =>      $this->GetFields('list','frontend', true),
        ];
    }
}
