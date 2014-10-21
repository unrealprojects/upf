<?php
namespace UpfControllers;

class CatalogController extends SectionsController{
    public $Upf_Page_Section = 'catalog';

    public $BaseUrl = '/backend/section/catalog/';
    public $Model = '\UpfModels\Catalog';
    public $HasMeta = true;
}
