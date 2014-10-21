<?php
namespace UpfControllers;

class CategoriesController extends FiltersController{
    public $Upf_Page_Section = 'categories';

    public $BaseUrl = '/backend/filter/categories/';
    public $Model = '\UpfModels\Categories';
}
