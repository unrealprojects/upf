<?php
namespace UpfControllers;

class PagesController extends SectionsController{
    public $Upf_Page_Section = 'pages';

    public $BaseUrl = '/backend/section/pages/';
    public $Model = '\UpfModels\Pages';


    public $HasMeta = true;
}
