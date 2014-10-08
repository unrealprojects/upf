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
    public function GetFields($View){
        $Model =  new \UpfModels\Fields();
        return $Model
            ->where('destination',$this->destination)
            ->where('table',$this->table)
            ->where('view',$View)
            ->orderBy('id')
            ->get();
    }

    /*** Get Field Values ***/
    public static function GetFieldValues($Values,$ValuesType,$SectionModel = false){
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
        }elseif($ValuesType=='config'){
            return \Config::get($Values);
        }elseif($ValuesType=='section'){
            echo $SectionModel;
            $SectionModel = new $SectionModel();
            $Section=$SectionModel->Section;

            return $SectionModel->all();
        }
    }
    /******************************************************************************************************************* Default Functionality ***/
    /*** Get Clear List ***/
    public function Index($Filter = []){
        $Query = $this
            ->paginate(isset($Filter['PageSize'])?$Filter['PageSize']:20);

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

    /******************************************************************************************************************* Add Item ***/
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
        $this->alias = $this->CreateUniqueAlias(\Mascame\Urlify::filter(isset($this->title)?$this->title:''),$this);

        $this->save();
        return '/'.\Request::segment(1) . '/' .\Request::segment(2) . '/' .\Request::segment(3) . '/' . $this->alias . '/' . 'edit';
    }


        /*** Edit Item ***/
    public function EditItem($Alias){
        /*** Get Content Model***/
        $ContentModel=$this
            ->where('alias',$Alias)
            ->first();
        /*** Result ***/
        return [
            'item' => $ContentModel->toArray(),
            'fields' =>$this->GetFields('edit')
        ];
    }

    /******************************************************************************************************************* Update Item ***/



    public function UpdateItem($Alias,$Input){
        /*** Get Fields ***/
        $Fields = $this->GetFields('edit');

        $Result = $this->where('alias',$Alias)->first();
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
                }elseif(\Input::get($Field->relation) && $Field['type']=='multi-select' && $Field['editable']){
                    if(empty($FieldExplode[1])){
                        $Keys = [];
                        foreach($Input[$Field->relation] as $Key){
                            $Keys[$Key] = ['section'=>$this->Section];
                        }
                        $Result->{$FieldExplode[0]}()->sync($Keys);
                    }else{
                        $Keys = [];
                        foreach($Input[$Field->relation] as $Key){
                            $Keys[$Key] = ['section'=>$this->Section];
                        }
                        $Result->{$FieldExplode[0]}->{$FieldExplode[1]}()->sync($Keys);
                    }
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
            }
            $Result->save();
        }
        return true;
    }

    /******************************************************************************************************************* Remove Item ***/
    public function Remove($Alias){
        $Result = $this->where('alias',$Alias)->first();
        $Result->delete();
        $Result->meta()->delete();
        return true;
    }

    /*** Remove Logotype***/
    public function RemoveLogotype($Alias){
        $Result =  $Result = $this->where('alias',$Alias)->first();
        $Result->logotype='';
        $Result->save();
        return true;
    }
}
