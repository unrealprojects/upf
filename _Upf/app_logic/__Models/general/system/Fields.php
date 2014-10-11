<?php

namespace UpfModels;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Fields extends General {
    public $timestamps = false;
	protected $table = 'system_fields';

    /******************************************************************************************************************* Fields Functionality ***/

    /*** Get All Field Indicated From View ***/

        public function GetFields($View, $Destination = 'backend', $Sort = false){

            /*** Default***/
                $Model =  new \UpfModels\Fields();

            /*** Get Fields ***/
                $Fields = $Model->where('destination',$Destination)
                                 ->where('table',$this->table)
                                 ->where('view',$View)
                                 ->orderBy('id')
                                 ->get();

            /*** Sort Fields By Group ***/
                if($Sort){
                    $SortedFields = [];
                    $Groups = \Config::get('models/Fields.field_groups');

                    foreach($Fields->toArray() as $Field){
                        foreach($Groups as $GroupKey => $Group){
                            if($GroupKey==$Field['group']){
                                $SortedFields[$GroupKey][$Field['relation']] = $Field;
                            }
                        }
                    }

                    /*** Sorted :: Group -> Fields ***/
                        return $SortedFields;
                }else{

                    /*** Don't sort ***/
                        return $Fields;
                }
        }





    /*** Get Field Values Set ***/
        public static function GetFieldValues($Values,$ValuesType,$SectionModel = false){
            /*** Values Form Values ***/
                if($ValuesType=='model'){
                    if($SectionModel){
                        $SectionModel = new $SectionModel();
                        $Section=$SectionModel->Section;
                    }else{
                        $Section='';
                    }
                    $Model = '\UpfModels\\' .$Values;

                    $Model = new $Model();
                    /*** For Filters with Section  ***/
                    if(($Values=='Categories' || $Values=='Tags') && $Section){
                        return $Model->where('section',$Section)->get();
                    }else{
                        return $Model->all();
                    }

                /*** Values From Config ***/
                    }elseif($ValuesType=='config'){
                        return \Config::get($Values);

                /*** Values From Section ***/
                    }elseif($ValuesType=='section'){
                        $SectionModel = new $SectionModel();
                        $Section = $SectionModel->Section;

                        return $SectionModel->all();
                    }
        }


    /******************************************************************************************************************* Get Item By Alias ***/

    /*** *** Get Item By Alias *** ***/

    public static function GetItemByField($Alias, $Meta = false, $SearchField = false, $Model){

        /*** We Have Meta Or Search Field ***/
        if($SearchField || !$Meta){
            /*** Default Search Filed ***/
            if(!$SearchField){
                $SearchField = 'alias';
            }
            /*** By Field ***/
            return $Model->where($SearchField,$Alias)->first();
        }else{
            /*** By Alias in Meta ***/
            return $Model->WhereAliasInMeta($Model,$Alias)
                ->with('meta',
                    'meta.categories',
                    'meta.tags',
                    'meta.regions',
                    'meta.comments',
                    'meta.files',
                    'meta.categories.params',
                    'meta.paramsvalues',
                    'meta.paramsvalues.params')->first();
        }
    }

    /******************************************************************************************************************* Get List ***/

    public function Index( $Filter = [], $Meta = false, $Division = 'backend'){
        /*** Get List ***/
            /*** With Meta ***/
            if($Meta){
                $List = $this->WhereStatusesInMeta($this,$Filter)
                    ->with(
                        'meta',
                        'meta.categories',
                        'meta.tags',
                        'meta.regions')
                    ->paginate(isset($Filter['Pagination'])?$Filter['Pagination']
                        :\Config::get('site\app_settings.Paginate.content'));

            }else{
                /*** Clear List ***/
                $List = $this->paginate(isset($Filter['PageSize'])?$Filter['PageSize']:20);
            }

        /*** Return Data ***/

            return [
                'List' => $List->toArray()['data'],
                'Fields' => $this->GetFields('list',$Division),
                'Pagination' => $List->appends(\Input::except('page'))->links(),
            ];
    }




    /******************************************************************************************************************* Add Item ***/

    public function AddItem($Meta = false, $RelatedUser = false){

        /*** Get Fields ***/
        $Fields = $this->GetFields('add');


        /*** For Updated Fields ***/
        foreach($Fields as $Field){
            $FieldExplode = explode('-',$Field->relation);

            /*** Add Data ***/

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

                    /*** Photo ***/
                }elseif($Field->type=='photo'){

                    if(\Input::hasFile('logotype')){

                        /*** Set File Src ***/
                        $FileSrc = $this->PhotosUrl.time().'_'.\Input::file('logotype')->getClientOriginalName();
                        \Input::file('logotype')->move(base_path().'/public'.$this->PhotosUrl,$FileSrc);
                        $this->logotype = $FileSrc;
                    }
                }
        }

        // Set User By Login
            if($RelatedUser){
                $RelatedUser = \UpfModels\Users::where('login',$RelatedUser)->first()->id;
            }

        /*** If Model Has Meta ***/
            if($Meta){
                /*** Save Meta ***/
                $Data = [
                    /*** Content ***/
                    'title' =>          $this->title,
                    'description' =>    $this->title,
                    'keywords' =>       $this->title,
                    /*** Relations ***/
                    'section' =>        $this->Section,
                    'category_id' =>    0 ,
                    'user_id' =>        $RelatedUser ,
                    /*** Statuses ***/
                    'status' =>         1,
                    'privileges' =>     0,
                    'rating' =>         0,
                    'favorite' =>       0
                ];

                /*** Save With Meta ***/
                $MetaRelations = \UpfSeeds\MetaSeeder::AddMetaToSection($Data);
                    // Meta Relation
                    $this->meta_id = $MetaRelations[0];

                    if($this->login){
                        $this->login = $MetaRelations[1];
                    }
                $LinkAlias = $MetaRelations[1];
            }else{
                $this->alias = $this->CreateUniqueAlias(\Mascame\Urlify::filter(isset($this->title)?$this->title:''),$this);
                $LinkAlias = $this->alias;
            }

        /*** Save ***/
            $this->save();

        /*** Return Url To Redirect ***/
            return '/'.\Request::segment(1) . '/' .\Request::segment(2) . '/' .\Request::segment(3) . '/' . $LinkAlias . '/' . 'edit';
    }






    /******************************************************************************************************************* Edit Item ***/

    public function EditItem($Alias, $Meta = false, $SearchField = false, $Division = 'backend'){
        /*** Get Item By Field ***/
        $Item = $this->GetItemByField($Alias, $Meta, $SearchField, $this);

        /*** Result ***/
        return [
            'Item' =>       $Item,
            'Fields' =>     $this->GetFields('edit',$Division)
        ];

    }




    /******************************************************************************************************************* Update Photos ***/

        public function UpdateItemPhotos($Alias, $Meta = false, $SearchField = false){
            /*** Photos Array ***/
            $UpdatedPhotos = [];


            /*** Get Item By Field ***/
            $Item = $this->GetItemByField($Alias, $Meta, $SearchField, $this);


            /*** Write Logotype ***/

            if(\Input::hasFile('logotype')){
                /*** Set File Src ***/
                $FileSrc = $this->PhotosUrl.time().'_'.\Input::file('logotype')->getClientOriginalName();

                /*** Save ***/
                \Input::file('logotype')->move(base_path().'/public'.$this->PhotosUrl,$FileSrc);
                $Item->logotype = $FileSrc;
                $UpdatedPhotos['logotype'] = $FileSrc;
                $Item->save();
            }

            /*** Write Files ***/
            if(!$Meta){
                if(\Input::hasFile('meta-files')){
                    foreach(\Input::file('meta-files') as $Key=>$Photo){
                        $File = new \UpfModels\Files();

                        $FileSrc = $this->PhotosUrl.time() . '_' . $Photo->getClientOriginalName();
                        $Photo->move(base_path().'/public'.$this->PhotosUrl,$FileSrc);
                        $File->src = $FileSrc;
                        $File->save();

                        /*** Save Relations ***/
                        $Item->meta->files()->attach([$File->id]);

                        /*** Save Photos ***/
                        $UpdatedPhotos['photos'][$Key]['src'] = $FileSrc;
                        $UpdatedPhotos['photos'][$Key]['id'] = $File->id;
                    }
                }
                return $UpdatedPhotos;
            }
        }




    /******************************************************************************************************************* Update Item ***/

    public function UpdateItem($Alias, $Meta = false, $SearchField = false){
        /*** Get Fields ***/

        $Fields = $this->GetFields('edit');
        $Input = \Input::all();

        /*** Get Item To Update ***/
            $Item = $this->GetItemByField($Alias, $Meta, $SearchField, $this);


        foreach($Fields as $Field){

            $FieldExplode = explode('-',$Field->relation);
            if(isset($Input[$Field->relation])){

                /*** Text ***/
                if(\Input::get($Field->relation) && ($Field->type=='text' || $Field->type=='textarea') && $Field->editable){
                    if(empty($FieldExplode[1])){
                        $Item->{$FieldExplode[0]} = $Input[$FieldExplode[0]];
                    }else{
                        $Item->$FieldExplode[0]()->update([
                            $FieldExplode[1] => $Input[$Field->relation]
                        ]);
                    }

                    /*** Password ***/
                }elseif(\Input::get($Field->relation) && $Field->type=='password' && $Field->editable){
                    if(empty($FieldExplode[1])){
                        $Item->{$FieldExplode[0]} = \Hash::make($Input[$FieldExplode[0]]);
                    }else{
                        $Item->$FieldExplode[0]()->update([
                            $FieldExplode[1] => \Hash::make($Input[$Field->relation])
                        ]);
                    }

                    /*** Multi Select ***/
                }elseif(\Input::get($Field->relation) && isset($FieldExplode[1]) && $Field['type']=='multi-select' && $Field['editable']){
                    $Keys = [];
                    foreach($Input[$Field->relation] as $Key){
                        $Keys[$Key] = ['section'=>$this->Section];
                    }
                    $Item->{$FieldExplode[0]}->{$FieldExplode[1]}()->sync($Keys);

                    /*** Select ***/
                }elseif($Field['type']=='select' && $Field['editable']){
                    if(empty($FieldExplode[1])){
                        $Item->{$FieldExplode[0]} = $Input[$FieldExplode[0]];
                    }else{
                        $Item->$FieldExplode[0]()->update([
                            $FieldExplode[1] => $Input[$Field->relation]
                        ]);
                    }
                }

                /*** Params ***/
            }elseif($Field->type=='params'){
                if(\Input::has('params')){
                    foreach(\Input::get('params') as $InputKey => $InputParam){
                        $Value = new \UpfModels\ParamsValues();
                        $Param = \UpfModels\Params::where('alias',$InputKey)->first();
                        if($Param){

                            if($PresetValue = \UpfModels\ParamsValues::where('item_id',$Item->meta_id)->where('param_id',$Param->id)->first()){
                                $PresetValue->delete();
                            }

                            $Value->item_id = $Item->meta_id;
                            $Value->value = $InputParam;
                            $Value->param_id = $Param->id;

                            $Value->save();
                        }
                    }
                }
            }
            /*** Save Item ***/
            $Item->save();
        }

        return true;
    }


    /******************************************************************************************************************* Remove Item ***/

    /*** Remove Item ***/

    public function Remove($Alias, $Meta=false, $SearchField=false){
        /*** Get Item By Field ***/
        $Item = $this->GetItemByField($Alias, $Meta, $SearchField, $this);

        /*** Delete ***/

        $Result = $Item->delete();

        if($Meta){
            return $Item->meta()->delete();
        }else{
            return $Result;
        }
    }




    /*** Remove Photo ***/

    public function RemovePhoto($Alias, $Id, $Meta = false, $SearchField=false){

        /*** Get Item By Field ***/
        $Item = $this->GetItemByField($Alias, $Meta, $SearchField, $this);

        /*** Delete ***/
        return  $Item->files()->detach([$Id]);
    }





    /*** Remove Logotype ***/

    public function RemoveLogotype($Alias, $Meta = false, $SearchField = false){
        /*** Get Item By Field ***/
        $Item = $this->GetItemByField($Alias, $Meta, $SearchField, $this);

        /*** Delete ***/
        $Item->logotype='';
        return $Item->save();
    }







    /******************************************************************************************************************* Cabinet ***/

    /*** *** Get Cabinet List Front Item *** ***/


    public function CabinetList($Login,$Filter = []){

        /*** Get Data ***/
        $List = $this->WhereStatusesInMeta($this,$Filter)
            ->whereHas('meta',function($Query) use($Login){
                $Query->whereHas('users',function($Query) use($Login){
                    $Query->where('login',$Login);
                });
            })
            ->with('meta',
                'meta.users',
                'meta.categories',
                'meta.tags',
                'meta.regions',
                'meta.files',
                'meta.categories.params',
                'meta.paramsvalues',
                'meta.paramsvalues.params')
            ->paginate(
                isset($Filter['Pagination'])?$Filter['Pagination']
                    :\Config::get('site\app_settings.PaginateFrontend.content')
            );

        /*** Return Frontend Content ***/
        return [
            'List'          =>      $List->toArray()['data'],
            'Fields'        =>      $this->GetFields('list','backend', false),
            'Pagination'    =>      $List->appends(\Input::except('page'))->links(),
            'Filters'       =>      $this->FrontFilters()
        ];
    }



}