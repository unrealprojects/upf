<?php
namespace UpfControllers;

class TagsController extends FiltersController{
    public $Upf_Page_Section = 'tags';

    public $BaseUrl = '/backend/filter/tags/';
    public $Model = '\UpfModels\Tags';
}
