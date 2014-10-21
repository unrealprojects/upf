<?php
namespace UpfControllers;

class ArticlesController extends SectionsController {
    public $Upf_Page_Section = 'articles';

    public $BaseUrl = '/backend/section/articles/';
    public $Model = '\UpfModels\Articles';
    public $HasMeta = true;
}
