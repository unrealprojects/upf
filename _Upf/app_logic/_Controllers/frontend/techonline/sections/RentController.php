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
            'TabsNode'=>     'Node-XXS-6 Node-XS-3'
        ];

    }
}
