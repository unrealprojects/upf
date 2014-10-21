<?php
namespace UpfControllers;

class PartsController extends SectionsController{
    public $Upf_Page_Section = 'parts';

    public $BaseUrl = '/backend/section/parts/';
    public $Model = '\UpfModels\Parts';
    public $HasMeta = true;
}

