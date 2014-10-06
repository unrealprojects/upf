<?php

namespace UpfModels;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Fields extends General {
    public $timestamps = false;
	protected $table = 'system_fields';

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

    /*** Get Field Values***/
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
        }
    }

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

    /*** Update Item ***/
    public function UpdateItem($Alias,$Input){
        /*** Get Fields ***/
        $Fields = $this->GetFields('edit');


        $Result = $this->where('alias',$Alias)->first();
        foreach($Fields as $Field){
            $FieldExplode = explode('-',$Field->relation);

            if(\Input::get($FieldExplode[0]) && empty($FieldExplode[1])){
                $Result->{$FieldExplode[0]} = $Input[$FieldExplode[0]];
            }elseif(\Input::get($Field->relation) && isset($FieldExplode[1]) && $FieldExplode[1]=='tags'){
                //print_r($Input[$Field->relation]);
                //$Result->{$FieldExplode[1]}()->sync([$Input[$Field->relation]]);
            }
        }

        /*  $Result->title = $Input['title'];
          $Result->intro = $Input['intro'];
          $Result->text = $Input['text'];




          $Result->meta()->update(
              [
                  'title'=>$Input['meta-title'],
                  'description'=>$Input['meta-description'],
                  'keywords'=>$Input['meta-keywords'],
                  'region_id'=>$Input['meta-region_id'],
                  'category_id'=>$Input['meta-category_id'],
              ]
          );
          $Result->tags()->sync($Input['meta-tags']);
          */
        return $Result->save();

    }
}
