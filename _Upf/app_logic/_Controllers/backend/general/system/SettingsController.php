<?php
namespace UpfControllers;

class SettingsController extends BackendController{
    public $BaseUrl = '/backend/system/settings/';
    public $Model = '\UpfModels\Settings';
    public $View = '/backend/standard/layouts/system/';

    /*** Show List ***/
    public function Index(){
        // View Data
        $this->ViewData['content'] = [
            'data' => \Config::get('site/app_settings')
        ];
        return \View::make($this->View.'Settings',$this->ViewData);
    }

    public function Update(){

        foreach(\Config::get('site/app_settings') as $relation => $value){
            \UpfHelpers\SaveConfig::Write('site/app_settings.php', [$relation .'.content' => \Input::get($relation)]);
        }
        echo json_encode([ 'message'=>'Настройки сохранены.','type'=>'Success']);

    }


}
