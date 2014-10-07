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
            if($Values=='Categories' || $Values=='Tags'){
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
        $Fields = $this->GetFields('add');
        /*** Content ***/
        $this->title = \Input::get('title');

        if(\Input::hasFile('logotype')){
            /*** Set File Src ***/
            $FileSrc = $this->PhotosUrl.time().'_'.\Input::file('logotype')->getClientOriginalName();
            \Input::file('logotype')->move(base_path().'/public'.$this->PhotosUrl,$FileSrc);
            $this->logotype = $FileSrc;
        }


        $this->intro = \Input::get('intro');
        $this->text = \Input::get('text');

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

        $Result = $this->where($Alias)->first();
        foreach($Fields as $Field){
            $FieldExplode = explode('-',$Field->relation);

            /*** Text ***/
            if(\Input::get($Field->relation) && $Field->type=='text' && $Field->editable){
                if(empty($FieldExplode[1])){
                    $Result->{$FieldExplode[0]} = $Input[$FieldExplode[0]];
                }else{
                    $Result->$FieldExplode[0]()->update([
                        $FieldExplode[1] => $Input[$Field->relation]
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
            $Result->save();
        }
        return $Result->save();
    }
}
