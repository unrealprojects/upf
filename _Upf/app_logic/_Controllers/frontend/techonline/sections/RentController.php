<?php
namespace UpfFrontendControllers;

class RentController extends SectionsController{
    public $Upf_Page_Section = 'rent';

    public $Model = '\UpfModels\Rent';
    public $BaseUrl = '/rent/';

    public function __construct(){
        parent::__construct();

        // Set Filters
        $this->ViewData['HasFilters'] = [
            'Categories' =>  true,
            'Regions' =>     true,
            'Tags' =>        true,
            'Params' =>      true,
            'Price' =>       true,
            'TabsNode'=>     'Node-XXS-12 Node-XS-4'
        ];

    }
}
