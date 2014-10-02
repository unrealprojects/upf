<?php

namespace UpfModels;

class Meta extends Fields {
    protected $table = 'system_meta';
    public $Config = 'models/backend/sections/Meta';
    public $PhotosUrl = '/photo/standard/system/meta/';

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

    /*** Categories :: Has Many ***/
    public function categories()
    {
        return $this->hasMany('UpfModels\Categories','id','category_id');
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
            ->paginate(isset($Filter['PageSize'])?$Filter['PageSize']:20);
        //print_r($this->GetFields('list')->toArray());
        return [
            'list' => $Query->toArray()['data'],
            'fields' => $this->GetFields('list'),
            'pagination' => $Query->appends(\Input::except('page'))->links(),
        ];
    }
    /*** Add Item ***/
    public function AddItem(){
        return [
            'fields' =>$this->GetFields('add')
        ];
    }

    /*** Edit Item ***/
    public function EditItem($Alias){
        /*** Get Content Model***/
        $ContentModel=$this
            ->WhereAliasInMeta($this,$Alias)
            ->with(
                'meta',
                'meta.categories',
                'meta.tags',
                'meta.regions',
                'meta.files')
            ->first();
        /*** Result ***/
        return [
            'item' => $ContentModel->toArray(),
            'fields' =>$this->GetFields('edit')
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
            $Result->text = $Input['text'];

            $Result->meta()->title = 'asdf';
            $Result->meta()->update(
                [
                    'title'=>$Input['meta_title'],
                    'description'=>$Input['meta_description'],
                    'keywords'=>$Input['meta_keywords'],
                    'region_id'=>$Input['meta_region_id'],
                    'category_id'=>$Input['meta_category_id'],
                ]
            );
            $Result->tags()->sync($Input['meta_tags']);
            return $Result->save();
        }else{
            return false;
        }
    }

    /*** Update Item Files ***/                                                                                         /*** todo :: to Files Model ***/
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
            foreach(\Input::file('meta-files') as $Photo){
                $File = new \UpfModels\Files();

                $FileSrc = $this->PhotosUrl.time() . '_' . $Photo->getClientOriginalName();
                $Photo->move(base_path().'/public'.$this->PhotosUrl,$FileSrc);
                $File->src = $FileSrc;
                $File->save();
                /*** Save Relations ***/
                $Model->files()->attach([$File->id]);
                /*** Save Photos ***/
                $UpdatedPhotos['photos'][] = $FileSrc;
            }
        }

        return $UpdatedPhotos;
    }

    /*** Remove Item ***/
    public function Remove($Alias){
        $Result = $this->WhereAliasInMeta($this,$Alias)->first();
        $Result->delete();
        $Result->meta()->delete();
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
}