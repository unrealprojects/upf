<?php
namespace UpfFrontendControllers;

class CatalogController extends SectionsController{
    public $Upf_Page_Section = 'catalog';

    public $Model = '\UpfModels\Catalog';
    public $BaseUrl = '/catalog/';


    public function __construct(){
        parent::__construct();

        // Set Filters
        $this->ViewData['HasFilters'] = [
            'Categories' => true,
            'Regions' =>    false,
            'Tags' =>       true,
            'Params' =>     true,
            'Price' =>      false,
            'TabsNode'=>    'Node-XXS-12 Node-XS-6'
        ];

    }

}
