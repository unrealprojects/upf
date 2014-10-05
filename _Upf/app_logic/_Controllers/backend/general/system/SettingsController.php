<?php
namespace UpfControllers;

class SettingsController extends BackendController{
    public $BaseUrl = '/backend/system/settings/';
    public $Model = '\UpfModels\Settings';
    public $View = '/backend/standard/layouts/system/';

    /*** Show List ***/
    public function index(){
        // View Data
        $this->viewData['content'] = [
            'data' => \Config::get('site/app_settings')
        ];
        return \View::make($this->View.'Settings',$this->viewData);
    }

    public function update(){
        $Input = \Input::all();

        if($Input){
            foreach(\Config::get('site/app_settings') as $relation => $value){
                \UpfHelpers\SaveConfig::Write('site/app_settings.php', [$relation .'.content' => \Input::get($relation)]);
            }
            echo json_encode([ 'message'=>'Запись успешно обновлена.','type'=>'Success']);
        }else{
            echo json_encode(['message'=>'Невозможно обновить запись.','type'=>'Error']);
        }
    }


}
