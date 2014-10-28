<?php
namespace UpfFrontendControllers;

class ArticlesController extends SectionsController{
    public $Upf_Page_Section =      'articles';

    public $Model =                 '\UpfModels\Articles';
    public $BaseUrl =               '/articles/';



    public function __construct(){
        parent::__construct();

        // Set Filters
        $this->ViewData['HasFilters'] = [
            'Categories' => false,
            'Regions' =>    false,
            'Tags' =>       true,
            'Params' =>     false,
            'TabsNode'=>     'Node-XXS-12 Node-XS-12'
        ];

    }
}
