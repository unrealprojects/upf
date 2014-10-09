<?php

namespace UpfModels;

class Meta extends Fields {
    public $timestamps = true;
    protected $table = 'system_meta';
    public $Config = 'models/backend/sections/Meta';
    public $PhotosUrl = '/photo/standard/system/meta/';
    public $Section = '';

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
        return $this->hasMany('UpfModels\Regions','id','region_id');
    }


    /******************************************************************************************************************* Where ***/

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
            return $This;
        }else{
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
            });
        }

    }
    /*******************************************************************************************************************  Main Functions ***/

    /*** Get List ***/
    public function Index($Filter = []){
        $Query = $this
            ->WhereStatusesInMeta($this,$Filter)
            ->with(
                'meta',
                'meta.categories',
                'meta.tags',
                'meta.regions')
            ->paginate(isset($Filter['Pagination'])?$Filter['Pagination']:\Config::get('site\app_settings.Paginate.content'));

        return [
            'list' => $Query->toArray()['data'],
            'fields' => $this->GetFields('list'),
            'pagination' => $Query->appends(\Input::except('page'))->links(),
        ];
    }

    /*** Get Item Add Fields***/
    public function AddItemFields(){
        return [
            'fields' =>$this->GetFields('add')
        ];
    }

    /******************************************************************************************************************* Get Item Add Fields***/
    public function AddItem(){
        /*** Get Fields ***/
        $Fields = $this->GetFields('add');
        foreach($Fields as $Field){
            $FieldExplode = explode('-',$Field->relation);
            /*** Text ***/
            if(\Input::get($Field->relation) && ($Field->type=='text' || $Field->type=='textarea')  && $Field->editable){
                if(empty($FieldExplode[1])){
                    $this->{$FieldExplode[0]} = \Input::get($FieldExplode[0]);
                }else{
                    $this->$FieldExplode[0]()->update([
                        $FieldExplode[1] => \Input::get($Field->relation)
                    ]);
                }
                /*** Password ***/
            }elseif(\Input::get($Field->relation) && $Field->type=='password' && $Field->editable){
                if(empty($FieldExplode[1])){
                    $this->{$FieldExplode[0]} = \Hash::make(\Input::get($FieldExplode[0]));
                }else{
                    $this->$FieldExplode[0]()->update([
                        $FieldExplode[1] => \Hash::make(\Input::get($Field->relation))
                    ]);
                }
            }elseif($Field->type=='photo'){

                if(\Input::hasFile('logotype')){

                    /*** Set File Src ***/
                    $FileSrc = $this->PhotosUrl.time().'_'.\Input::file('logotype')->getClientOriginalName();
                    \Input::file('logotype')->move(base_path().'/public'.$this->PhotosUrl,$FileSrc);
                    $this->logotype = $FileSrc;
                }
            }
        }


        /*** Meta ***/
        $Data = [
            /*** Content ***/
            'title' => $this->title,
            'description' => $this->title,
            'keywords' => $this->title,
            /*** Relations ***/
            'section' => 'articles',
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
        if($this->login){
            $this->login = $Meta[1];
        }
        $this->save();
        return '/'.\Request::segment(1) . '/' .\Request::segment(2) . '/' .\Request::segment(3) . '/' . $Meta[1] . '/' . 'edit';
    }

    /*** Edit Item ***/
    public function EditItem($Alias){
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
            ->first()->toArray();
       // print_r($ContentModel);exit;

        /*** Result ***/
        return [
            'item' => $ContentModel,
            'fields' =>$this->GetFields('edit')
        ];
    }

    /******************************************************************************************************************* Update Item ***/
    public function UpdateItem($Alias,$Input){
            /*** Get Fields ***/
            $Fields = $this->GetFields('edit');

            $Result = $this->WhereAliasInMeta($this,$Alias)->first();
            foreach($Fields as $Field){
                $FieldExplode = explode('-',$Field->relation);
                if(isset($Input[$Field->relation])){
                    /*** Text ***/
                    if(\Input::get($Field->relation) && ($Field->type=='text' || $Field->type=='textarea') && $Field->editable){
                        if(empty($FieldExplode[1])){
                            $Result->{$FieldExplode[0]} = $Input[$FieldExplode[0]];
                        }else{
                            $Result->$FieldExplode[0]()->update([
                                $FieldExplode[1] => $Input[$Field->relation]
                            ]);
                        }
                    /*** Password ***/
                    }elseif(\Input::get($Field->relation) && $Field->type=='password' && $Field->editable){
                        if(empty($FieldExplode[1])){
                            $Result->{$FieldExplode[0]} = \Hash::make($Input[$FieldExplode[0]]);
                        }else{
                            $Result->$FieldExplode[0]()->update([
                                $FieldExplode[1] => \Hash::make($Input[$Field->relation])
                            ]);
                        }
                    /*** Multi Select ***/
                    }elseif(\Input::get($Field->relation) && isset($FieldExplode[1]) && $Field['type']=='multi-select' && $Field['editable']){
                        $Keys = [];
                        foreach($Input[$Field->relation] as $Key){
                            $Keys[$Key] = ['section'=>$this->Section];
                        }
                        $Result->{$FieldExplode[0]}->{$FieldExplode[1]}()->sync($Keys);

                    /*** Select ***/
                    }elseif($Field['type']=='select' && $Field['editable']){
                        if(empty($FieldExplode[1])){
                            $Result->{$FieldExplode[0]} = $Input[$FieldExplode[0]];
                        }else{
                            $Result->$FieldExplode[0]()->update([
                                $FieldExplode[1] => $Input[$Field->relation]
                            ]);
                        }
                    }
                }elseif($Field->type=='params'){
                    if(\Input::has('params')){
                        foreach(\Input::get('params') as $InputKey => $InputParam){
                            $Value = new \UpfModels\ParamsValues();
                            $Param = \UpfModels\Params::where('alias',$InputKey)->first();
                            if($Param){

                                if($PresetValue = \UpfModels\ParamsValues::where('item_id',$Result->meta_id)->where('param_id',$Param->id)->first()){
                                    $PresetValue->delete();
                                }
                                $Value->item_id = $Result->meta_id;
                                $Value->value = $InputParam;
                                $Value->param_id = $Param->id;

                                $Value->save();
                            }
                        }
                    }
                }

                $Result->save();
            }
            return true;
    }

    /*** Update Item Files ***/
    public function UpdateItemPhotos($Alias){
        $UpdatedPhotos = [];
        $Model = $this->WhereAliasInMeta($this,$Alias)->first();

        /*** Write Logotype ***/
        if(\Input::hasFile('logotype')){
            /*** Set File Src ***/
            $FileSrc = $this->PhotosUrl.time().'_'.\Input::file('logotype')->getClientOriginalName();
            \Input::file('logotype')->move(base_path().'/public'.$this->PhotosUrl,$FileSrc);
            $Model->logotype = $FileSrc;
            $UpdatedPhotos['logotype'] = $FileSrc;
            $Model->save();
        }

        /*** Write Files ***/
        if(\Input::hasFile('meta-files')){
            foreach(\Input::file('meta-files') as $Key=>$Photo){
                $File = new \UpfModels\Files();

                $FileSrc = $this->PhotosUrl.time() . '_' . $Photo->getClientOriginalName();
                $Photo->move(base_path().'/public'.$this->PhotosUrl,$FileSrc);
                $File->src = $FileSrc;
                $File->save();
                /*** Save Relations ***/
                $Model->meta->files()->attach([$File->id]);
                /*** Save Photos ***/
                $UpdatedPhotos['photos'][$Key]['src'] = $FileSrc;
                $UpdatedPhotos['photos'][$Key]['id'] = $File->id;
            }
        }
        return $UpdatedPhotos;
    }

    /******************************************************************************************************************* Remove Item ***/
    public function Remove($Alias){
        $Result = $this->WhereAliasInMeta($this,$Alias)->first();
        $Result->delete();
        $Result->meta()->delete();
        return true;
    }

    /*** Remove Photo***/
    public function RemovePhoto($Alias,$Id){
        $Result = $this->WhereAliasInMeta($this,$Alias)->first();
        $Result->files()->detach([$Id]);
        return true;
    }

    /*** Remove Logotype***/
    public function RemoveLogotype($Alias){
        $Result = $this->WhereAliasInMeta($this,$Alias)->first();
        $Result->logotype='';
        $Result->save();
        return true;
    }

    /*******************************************************************************************************************  Easy Functions ***/

    /*** To Trash ***/
    public function ChangeStatus($Alias,$Status){
        $Result = $this->WhereAliasInMeta($this,$Alias)->first();
        $Result->status = $Status;
        $Result->save();
    }

    /*** To Favorite ***/
    public function ToFavorite($Alias){
        $Result = $this->WhereAliasInMeta($this,$Alias)->first();
        $Result->favorite = true;
        $Result->save();
    }

    /*** From Favorite ***/
    public function FromFavorite($Alias){
        $Result = $this->WhereAliasInMeta($this,$Alias)->first();
        $Result->favorite = false;
        $Result->save();
    }


    /******************************************************************************************************************* ***/
    /******************************************************************************************************************* ***/

    /*** ***    Front Functions     *** ***/

    /******************************************************************************************************************* ***/
    /******************************************************************************************************************* ***/




    /*** *** Get Front List *** ***/
    public function FrontIndex($Filter = []){
        /*** Get Data ***/
        $List = $this->WhereStatusesInMeta($this,$Filter)
            ->with('meta',
                   'meta.categories',
                   'meta.tags',
                   'meta.regions',
                   'meta.files',
                   'meta.categories.params',
                   'meta.paramsvalues')
            ->paginate(
                isset($Filter['Pagination'])?$Filter['Pagination']
                                            :\Config::get('site\app_settings.PaginateFrontend.content')
            );

        /*** Return Frontend Content ***/
        return [
            'List'          =>      $List->toArray()['data'],
            'Fields'        =>      $this->GetFields('list','frontend', true),
            'Pagination'    =>      $List->appends(\Input::except('page'))->links(),
            'Filters'       =>      $this->FrontFilters()
        ];
    }




    /*** *** Get Front Filters *** ***/

    public function FrontFilters(){

        /*** Categories List ***/
        $Categories     =       \UpfModels\Categories::where( 'section', $this->Section )->get();

        /*** Tags List ***/
        $Tags           =       \UpfModels\Tags::where( 'section', $this->Section )->get();

        /*** Regions List ***/
        $Regions        =       \UpfModels\Regions::all();

        /*** Params List ***/
        $Params         =       \UpfModels\Params::where( 'section', $this->Section )->get();



        /*** Return Filters ***/
        return [
            'categories'    =>     $Categories,
            'tags'          =>     $Tags,
            'regions'       =>     $Regions,
            'params'        =>     $Params,
        ];
    }

}

