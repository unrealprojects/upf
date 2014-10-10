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

        /*** Show View ***/
        return \View::make($this->View . 'Edit' , $this->ViewData);
    }
}
