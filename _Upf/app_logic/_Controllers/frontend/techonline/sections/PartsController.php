<?php
namespace UpfFrontendControllers;

class PartsController extends SectionsController{
    public $Upf_Page_Section = 'parts';

    public $Model = '\UpfModels\Parts';
    public $BaseUrl = '/parts/';

    public function __construct(){
        parent::__construct();

        // Set Filters
        $this->ViewData['HasFilters'] = [
            'Categories' =>  true,
            'Regions' =>     true,
            'Tags' =>        true,
            'Params' =>      false,
            'Price' =>       true,
            'TabsNode'=>     'Node-XXS-6 Node-XS-4'
        ];

    }
}
