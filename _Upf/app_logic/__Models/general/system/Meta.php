<?php

namespace UpfModels;

class Meta extends General {
    protected $table = 'system_meta';
    public $Config = 'models/backend/sections/Meta';

    /*** *** Relations *** ***//////////////////////////////////////////////////////////////////////////////////////////

    /***  Tags :: Many To Many ***/
    public function tags()
    {
        return $this->belongsToMany('UpfModels\Tags', 'filter_tags_to_items', 'item_id', 'tag_id');
    }

    /*** Categories :: Has Many ***/
    public function categories()
    {
        return $this->hasMany('UpfModels\Categories','id','category_id');
    }

    /*** Relations :: Regions :: Has One ***/
    public function regions()
    {
        return $this->hasMany('UpfModels\Regions','id','region_id');
    }

    /*** *** Where *** ***//////////////////////////////////////////////////////////////////////////////////////////////

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
    /*** *** Main Functions *** ***/////////////////////////////////////////////////////////////////////////////////////

    /*** Get List ***/
    public function Index($Filter = []){
        $Query = $this
            ->WhereStatusesInMeta($this,$Filter)
            ->with(
                'meta',
                'meta.categories',
                'meta.tags',
                'meta.regions')
            ->paginate(isset($Filter['PageSize'])?$Filter['PageSize']:20);
        return [
            'list' => $Query->toArray()['data'],
            'fields' =>\Config::get($this->Config.'.list'),
            'pagination' => $Query->appends(\Input::except('page'))->links(),
        ];
    }

    /*** Edit Item ***/
    public function EditItem($Alias){
        $Result=$this
            ->WhereAliasInMeta($this,$Alias)
            ->with(
                'meta',
                'meta.categories',
                'meta.tags',
                'meta.regions')
            ->first();
        return [
            'item' => $Result->toArray(),
            'fields' =>\Config::get($this->Config.'.edit')
        ];
    }

    /*** Update Item ***/
    public function UpdateItem($Alias,$Input){
        $Validator = \Validator::make(
                [
                    'title' => $Input['title'],
                    'intro' => $Input['intro']
                ],
                [
                    'title' => 'required|min:5',
                    'intro' => 'required|min:5'
                ]
        );
        if(!$Validator->fails()){
            $Result = $this->WhereAliasInMeta($this,$Alias)->first();
            $Result->title = $Input['title'];
            $Result->intro = $Input['intro'];
            return $Result->save();
        }else{
            return false;
        }
    }

    /*** Remove Item ***/
    public function Remove($Alias){
        $Result = $this->WhereAliasInMeta($this,$Alias)->first();
        $Result->delete();
        $Result->meta()->delete();
        return true;
    }

    /*** *** Easy Functions *** ***/////////////////////////////////////////////////////////////////////////////////////

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
}