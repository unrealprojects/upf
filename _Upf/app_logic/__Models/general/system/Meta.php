<?php

namespace UpfModels;

class Meta extends Fields {
    public $timestamps = true;
    protected $table = 'system_meta';
    public $Config = 'models/backend/sections/Meta';
    public $PhotosUrl = '/photo/standard/system/meta/';
    public $Section = 'Meta';

    /******************************************************************************************************************* Relations ***/

    /***  Tags :: Many To Many ***/

        public function tags()
        {
            return $this->belongsToMany('UpfModels\Tags', 'filter_tags_to_items', 'item_id', 'tag_id');
        }


    /***  Photos :: Many To Many ***/

        public function files()
        {
            return $this->belongsToMany('UpfModels\Files', 'system_files_to_items', 'item_id', 'file_id');
        }


    /*** Categories :: Has One ***/

        public function categories()
        {
            return $this->hasOne('UpfModels\Categories','id','category_id');
        }


    /*** Params Values :: Has Many ***/

        public function paramsvalues()
        {
            return $this->hasMany('UpfModels\ParamsValues','item_id','id');
        }


    /*** Relations :: Regions :: Has One ***/

        public function regions()
        {
            return $this->hasOne('UpfModels\Regions','id','region_id');
        }


    /*** Relations :: Regions :: Has One ***/

        public function users()
        {
            return $this->hasOne('UpfModels\Users','id','user_id');
        }


    /*** Relations :: Regions :: Has Many ***/

        public function comments()
        {
            return $this->hasMany('UpfModels\Comments','wall_id','comments_id');
        }





    /******************************************************************************************************************* Helpers ***/

    /*** Where :: Alias in Meta ***/

        public static function WhereAliasInMeta($This,$Alias){
            return $This->whereHas('meta', function($Query) use ($Alias) {
                $Query->where('alias',$Alias);
            });
        }

    /*** Where :: Alias in Tags ***/

        public static function WhereAliasInTags($This,$Alias){
            return $This->whereHas('tags', function($Query) use ($Alias) {
                $Query->where('alias',$Alias);
            });
        }

    /*** Where :: Alias in Categories ***/

        public static function WhereAliasInCategories($This,$Alias){
            return $This->whereHas('tags', function($Query) use ($Alias) {
                $Query->where('alias',$Alias);
            });
        }

    /*** Where :: Statuses Filter in Meta ***/

        public static function WhereStatusesInMeta($This,$Filters){

            if($This->table=='system_meta'){
                // Exception
                return $This;
            }else{

                /*** Return Data ***/
                return $This->whereHas('meta', function($Query) use ($This,$Filters) {
                    /*** Status ***/
                    if(isset($Filters['status'])){
                        $Query->where('status',$Filters['status']);
                    }else{
                        $Query->where('status',\Config::get('models/Fields.status.active'));
                    }

                    /*** Privileges ***/
                    if(isset($Filters['privileges'])){
                        $Query->where('privileges',$Filters['privileges']);
                    }

                    /*** Filters ***/
                    if(isset($Filters['favorite'])){
                        $Query->where('privileges',$Filters['favorite']);
                    }

                    /*** Category  ***/
                    if(isset($Filters['category_alias'])){
                        $This->WhereAliasInCategories($Query,$Filters['category_alias']);
                    }

                    /*** Tag ***/
                    if(isset($Filters['tag_alias'])){
                        $This->WhereAliasInTags($Query,$Filters['tag_alias']);
                    }

                   // $This->orderBy('updated_at','DESC');
                });
            }

        }






    /*******************************************************************************************************************  Status ***/

    /*** Change Status ***/

        public function ChangeStatus($Alias, $Status, $SearchField=false){
            /*** Get Item By Field ***/
                $Item = $this->GetItemByField($Alias,$SearchField,$this);

            /*** Save ***/
                $Item->status = $Status;
                return $Item->save();
        }





    /*** To Favorite ***/

        public function ToFavorite($Alias,$SearchField=false){
            /*** Get Item By Field ***/
                $Item = $this->GetItemByField($Alias,$SearchField,$this);

            /*** Save ***/
                $Item->favorite = true;
                return $Item->save();
        }




    /*** From Favorite ***/

        public function FromFavorite($Alias,$SearchField=false){
            /*** Get Item By Field ***/
                $Item = $this->GetItemByField($Alias,$SearchField,$this);

            /*** Save ***/
                $Item->favorite = false;
                return $Item->save();
        }






    /******************************************************************************************************************* Front Functions ***/





    /*** *** Get Front List *** ***/

        public function FrontendIndex($Filter = []){

            /*** Get Data ***/
            $List = $this->WhereStatusesInMeta($this,$Filter)
                ->with('meta',
                       'meta.categories',
                       'meta.tags',
                       'meta.regions',
                       'meta.files',
                       'meta.categories.params',
                       'meta.paramsvalues',
                       'meta.paramsvalues.paramData'
                )
                ->paginate(
                    isset($Filter['Pagination'])?$Filter['Pagination']
                                                :\Config::get('site\app_settings.PaginateFrontend.content')
                );
          // print_r($List->toArray());exit;

            /*** Return Frontend Content ***/
            return [
                'List'          =>      $List->toArray()['data'],
                'Fields'        =>      $this->GetFields('list', 'frontend' , $Sort =  true),
                'Pagination'    =>      $List->appends(\Input::except('page'))->links(),
                'Filters'       =>      $this->Filters()
            ];
        }






        /*** Get Frontend Item ***/

        public function FrontendItem($Alias, $Meta = false, $SearchField = false, $Division = 'backend'){
            /*** Get Item By Field ***/
            $Item = $this->GetItemByField($Alias, $Meta, $SearchField, $this);

            /*** Result ***/
            return [
                'Item' =>       $Item,
                'Fields' =>     $this->GetFields('item', $Division = 'frontend' , $Sort = true)
            ];

        }




    /*** *** Get Front Home *** ***/

        public function FrontHome(){


            /*** Main Catalog Categories List ***/
            $MainCatalogCategories     =       \UpfModels\Categories::where( 'section', 'catalog' )
                                                                    ->where('parent_id',0)
                                                                    ->get()
                                                                    ->toArray();

            /*** Best Users List ***/
            $BestUsers      =    \UpfModels\Users::with('meta','meta.regions')
                                                   ->limit(6)
                                                   ->whereHas('meta',function($Query){
                                                        return $Query->orderBy('rating','desc');
                                                    })
                                                   ->get()
                                                   ->toArray();

            /*** Last Articles ***/
            $LastArticles      =    \UpfModels\Articles::with('meta','meta.regions','meta.tags')
                                                        ->limit(6)
                                                        ->whereHas('meta',function($Query){
                                                            return $Query->orderBy('rating','desc');
                                                        })
                                                        ->get()
                                                        ->toArray();

            /*** Return Filters ***/
                return [
                    'Filters'                   =>      $this->Filters('catalog'),
                    'MainCatalogCategories'     =>      $MainCatalogCategories,
                    'BestUsers'                 =>      $BestUsers,
                    'LastArticles'              =>      $LastArticles,
                ];
        }





    /*** *** Get Front Filters *** ***/

        public function Filters($Section = false){

            if(!$Section){
                $Section = $this->Section;
            }

            /*** Categories List ***/
            $Categories     =       \UpfModels\Categories::SortCategories(true);
            $CategoriesList =       \UpfModels\Categories::where( 'section', $Section )->get();

            /*** Tags List ***/
            $Tags           =       \UpfModels\Tags::where( 'section', $Section )->get();

            /*** Regions List ***/
            $Regions        =       \UpfModels\Regions::SortRegions(true);
            $RegionsList        =       \UpfModels\Regions::all();

            /*** Params List ***/
            $Params         =       \UpfModels\Params::where( 'section', $Section )->get();
            // Set Filter To Session



            /*** Return Filters ***/
            return [
                'categories'        =>     $Categories,
                'tags'              =>     $Tags,
                'regions'           =>     $Regions,
                'regions_list'      =>     $RegionsList,
                'categories_list'   =>     $CategoriesList,
               // 'params'        =>     $Params,
            ];
        }

}

