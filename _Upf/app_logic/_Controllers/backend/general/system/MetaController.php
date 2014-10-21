<?php
namespace UpfControllers;

class MetaController extends FieldsController{
    public $Upf_Page_Section = 'meta';

    public $BaseUrl = '/backend/system/meta/';
    public $Model = '\UpfModels\Meta';

    /******************************************************************************************************************* Meta ***/

    /*** Change Status ***/
    public function Status($alias,$status){
        $Articles = new $this->Model();
        $Articles->ChangeStatus($alias,$status);
    }

    /*** To Favorite Item ***/
    public function ToFavorite($alias){
        $Articles = new $this->Model();
        $Articles->ToFavorite($alias);
    }

    /*** From Favorite Item ***/
    public function FromFavorite($alias){
        $Articles = new $this->Model();
        $Articles->FromFavorite($alias);
    }
}
