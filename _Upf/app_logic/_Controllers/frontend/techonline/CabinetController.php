<?php
namespace UpfFrontendControllers;

class CabinetController extends FrontendController{
    public $Model = '\UpfModels\Users';
    public $BaseUrl = '/cabinet/';
    public $View = '/frontend/techonline/layouts/Cabinet/';

    public function Index(){
        /*** Default Model ***/
        $DefaultModel = new $this->Model();

        /*** Set Content ***/
        $this->ViewData['Content'] = $DefaultModel->CabinetItem($this->User['login']);
        /*print_r($this->ViewData['Content']);
        exit;*/
        /*** Show View ***/
        return \View::make($this->View . 'Edit' , $this->ViewData);
    }


}
/*        $Model = new $this->Model();
        $this->viewData['content'] = [
            'data' => $Model->EditItem($alias),
        ];

        return \View::make($this->View.'edit',$this->viewData);