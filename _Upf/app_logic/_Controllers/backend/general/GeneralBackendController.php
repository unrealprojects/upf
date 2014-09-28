<?php
namespace UpfControllers;

class GeneralBackendController extends BackendController{
    public function index(){
        $this->viewData['content'] = [];
        return \View::make('/backend/standard/layouts/upf/Main',$this->viewData);
    }
}
