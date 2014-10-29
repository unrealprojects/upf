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

        public static function FilterTagsFromRent($Aliases,$Query){
           return $Query->whereHas('catalog',function($QueryCatalog) use ($Aliases){
                $QueryCatalog->whereHas('meta',function($QueryMeta)  use ($Aliases){
                    $QueryMeta->whereHas('tags',function($QueryRegion) use ($Aliases){
                        $QueryRegion->whereIn('alias', $Aliases);
                    });
                });
            });
        }

    public static function FilterTags($Aliases,$Query){
        $Query->whereHas('tags',function($QueryRegion) use ($Aliases){
            $QueryRegion->whereIn('alias', $Aliases);
        });
    }





    /*** Where :: Alias in Categories ***/

        public static function FilterCategoriesFromRent($Alias, $Query){

            $Categories = new \UpfModels\Categories();
            $Category = $Categories->where('alias',$Alias)->first();

            if($Category){
                // Details Categories where('section', 'catalog')->get()
                $Parents = $Categories->where('parent_id',$Category->id)->get()->toArray();
                foreach($Parents as $Value){
                    $Keys[] = $Value['id'];
                }

                if(!empty($Keys)){
                    return $Query->whereHas('catalog',function($QueryCatalog) use ($Alias, $Keys){
                        $QueryCatalog->whereHas('meta',function($QueryMeta)  use ($Alias, $Keys){
                            $QueryMeta->whereHas('categories',function($QueryCategories)  use ($Alias, $Keys){
                                $QueryCategories->whereIn('id', $Keys)->whereOr('alias', $Alias);
                            });
                        });
                    });
                }else{
                    return $Query->whereHas('catalog',function($QueryCatalog) use ($Alias){
                        $QueryCatalog->whereHas('meta',function($QueryMeta)  use ($Alias){
                            $QueryMeta->whereHas('categories',function($QueryCategories)  use ($Alias){
                                $QueryCategories->where('alias',$Alias);
                            });
                        });
                    });
                }
            }else{

                return $Query->whereHas('catalog',function($QueryCatalog) use ($Alias){
                    $QueryCatalog->whereHas('meta',function($QueryMeta)  use ($Alias){
                        $QueryMeta->whereHas('categories',function($QueryCategories)  use ($Alias){
                            $QueryCategories->where('alias',$Alias);
                        });
                    });
                });
            }
        }

    public static function FilterCategories($Alias, $Query){

        $Categories = new \UpfModels\Categories();
        $Category = $Categories->where('alias',$Alias)->first();

        if($Category){
            // Details Categories where('section', 'catalog')->get()
            $Parents = $Categories->where('parent_id',$Category->id)->get()->toArray();
            foreach($Parents as $Value){
                $Keys[] = $Value['id'];
            }

            if(!empty($Keys)){
                $Query->whereHas('categories',function($QueryCategories)  use ($Alias,$Keys){
                    $QueryCategories->whereIn('id', $Keys)->whereOr('alias',$Alias);
                });
            }else{

                $Query->whereHas('categories',function($QueryCategories)  use ($Alias){
                    $QueryCategories->where('alias',$Alias);
                });
            }
        }else{

            $Query->whereHas('categories',function($QueryCategories)  use ($Alias){
                $QueryCategories->where('alias',$Alias);
            });
        }
    }








    /*** Where :: Params ***/

    public static function FilterParamsFromRent($Params, $Query){
        return $Query->whereHas('catalog', function($QueryCatalog) use($Params){
            $QueryCatalog->whereHas('meta',function($QueryMeta)  use ($Params){
                foreach($Params as $ParamKey => $Param){
                    $QueryMeta->whereHas('paramsvalues',function($QueryParamsValues) use($Param) {
                        $QueryParamsValues->where('param_id',$Param['id'])
                                          ->where('value','>=',$Param['min-value'])
                                          ->where('value','<=',$Param['max-value']);
                    });
                }
            });
        });
    }


    public static function FilterParams($Params, $Query){
                foreach($Params as $ParamKey => $Param){
                    $Query->whereHas('paramsvalues',function($QueryParamsValues) use($Param) {
                        $QueryParamsValues->where('param_id',$Param['id'])
                            ->where('value','>=',$Param['min-value'])
                            ->where('value','<=',$Param['max-value']);
                    });
                }
    }







    /*** *** Search In "SubRegions" *** ***/

    public static function FilterRegions($Alias,$Query){
         // Get Current Region
         $Regions = new \UpfModels\Regions();
         $Region = $Regions->where('alias',$Alias)->first();

         // Search In Parents
         if($Region)
         {
             $Parents = $Regions->where('parent_id',$Region->id)->get()->toArray();

             // Each Parent
             foreach($Parents as $Parent){
                 $Keys[]=$Parent['id'];
             }

            if(!empty($Keys)){
                 $Query->whereHas('regions',function($QueryRegion) use ($Alias,$Keys){
                     $QueryRegion->whereIn('id', $Keys)->whereOr('alias', $Alias);
                 });
            }else{
                $Query->whereHas('regions',function($QueryRegion) use ($Alias){
                    $QueryRegion->where('alias', $Alias);
                });
            }

         }else{
             $Query->whereHas('regions',function($QueryRegion) use ($Alias){
                 $QueryRegion->where('alias', $Alias);
             });
         }
    }



    /*** Where :: Statuses Filter in Meta ***/

        public function WhereStatusesInMeta($This,$Filters){
//
            $Filters = $this->SetFilters();

//           print_r($Filters);exit;

            if($This->table=='system_meta'){
                // Exception
                return $This;
            }else{

                /*** Return Data ***/
                $Result = $This->whereHas('meta', function($Query) use ($This,$Filters) {
                    /*** Status ***/
                    if(!empty($Filters['status'])){
                        $Query->where('status',$Filters['status']);
                    }else{
                        $Query->where('status',\Config::get('models/Fields.status.active'));
                    }

                    /*** Privileges ***/
                    if(!empty($Filters['privileges'])){
                        $Query->where('privileges',$Filters['privileges']);
                    }

                    /*** Favorite ***/
                    if(!empty($Filters['favorite'])){
                        $Query->where('privileges',$Filters['favorite']);
                    }


                    /*** *** Filters *** ***/

                    /*** Region ***/
                    if(!empty($Filters['Region'])){
                        $This->FilterRegions($Filters['Region'],$Query);
                    }

                    if(\Request::segment(1)!='rent'){
                        if(!empty($Filters['Category'])){
                            $This->FilterCategories($Filters['Category'],$Query);
                        }

                        /*** Tag ***/
                        if(!empty($Filters['Tags'])){
                            $This->FilterTags($Filters['Tags'],$Query);
                        }

                        /*** Params ***/
                        if(!empty($Filters['Params'])){
                            $This->FilterParams($Filters['Params'], $Query);
                        }
                    }
                });
            }

            /*** *** Filters To Catalog From Rent *** ***/

                /*** Category  ***/
            if(\Request::segment(1)=='rent' || !\Request::segment(1)){
                if(!empty($Filters['Category'])){
                    $Result = $This->FilterCategoriesFromRent($Filters['Category'],$Result);
                }

                /*** Tag ***/
                if(!empty($Filters['Tags'])){
                    $Result = $This->FilterTagsFromRent($Filters['Tags'],$Result);
                }

                /*** Params ***/
                if(!empty($Filters['Params'])){
                    $Result = $This->FilterParamsFromRent($Filters['Params'], $Result);
                }
            }

            if(!empty($Filters['Price']) && !empty($Filters['Price']['Min']) && !empty($Filters['Price']['Max'])){
                $Result = $Result->where('price','>=',$Filters['Price']['Min'])
                                 ->where('price','<=',$Filters['Price']['Max']);
            }

           return $Result;

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

            $Filter = $this->SetFilters();

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

            // I don't use sections here
            $Categories     =       \UpfModels\Categories::SortCategories(true);
            $CategoriesList =       \UpfModels\Categories::where( 'section', $Section )->get();

            /*** Tags List ***/
            if($Section == 'rent'){
                $Tags           =       \UpfModels\Tags::where( 'section', 'catalog' )->orderBy('privileges','desc')->get();
            }
            else
            {
                $Tags           =       \UpfModels\Tags::where( 'section', $Section )->orderBy('privileges','desc')->get();
            }


            /*** Regions List ***/
            $Regions            =       \UpfModels\Regions::SortRegions(true);
            $RegionsList        =       \UpfModels\Regions::all();

            /*** Params List ***/
            if( \Input::get('category') ){

            $Params = \UpfModels\Params::whereHas('categories',function($Query){
                $Query->where('alias',\Input::get('category'));
            })->get();
            }else{
                $Params = false;
            }
            // Set Filter To Session


            /*** Return Filters ***/
            return [
                'categories'        =>     $Categories,
                'tags'              =>     $Tags,
                'regions'           =>     $Regions,
                'regions_list'      =>     $RegionsList,
                'categories_list'   =>     $CategoriesList,
                'params'            =>     $Params
            ];
        }



        /*** *** Set Default Modules *** ***/
        public function SetFilters(){
            return [
                'Category' =>    \Input::get('category'),
                'Region' =>      \Input::get('region'),
                'Params' =>      \Input::get('params'),
                'Tags' =>        \Input::get('tags'),

                'Price' =>
                    [
                        'Min' => \Input::get('price-min'),
                        'Max' => \Input::get('price-max'),
                    ]
            ];
        }
}

