<?php
namespace UpfControllers;

class MetaController extends FieldsController{
    public $BaseUrl = '/backend/system/meta/';
    public $Model = '\UpfModels\Meta';

    /******************************************************************************************************************* Meta ***/

    /*** Change Status ***/
    public function status($alias,$status){
        $Articles = new $this->Model();
        $Articles->ChangeStatus($alias,$status);
    }

    /*** To Favorite Item ***/
    public function toFavorite($alias){
        $Articles = new $this->Model();
        $Articles->ToFavorite($alias);
    }

    /*** From Favorite Item ***/
    public function fromFavorite($alias){
        $Articles = new $this->Model();
        $Articles->FromFavorite($alias);
    }
}
