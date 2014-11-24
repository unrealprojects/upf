<?php
namespace UpfFrontendControllers;

class HomeController extends FrontendController{
    public $View = '/frontend/techonline/layouts/Home';
    public $Model = '\UpfModels\Meta';
    public $BaseUrl = '/';


    public function __construct(){
        parent::__construct();

        // Set Filters
        $this->ViewData['HasFilters'] = [
        'Categories' => true,
        'Regions' =>    true,
        'Tags' =>       true,
        'Params' =>     true,
        'Price' =>      true,
        'TabsNode'=>    'Node-XXS-6 Node-XS-3'
        ];

    }

    public function Index(){
        /*** Default Model ***/
        $DefaultModel = new $this->Model();

        /*** Set Content ***/
        $this->ViewData['Content'] = $DefaultModel->FrontHome();

        return \View::make($this->View,$this->ViewData);
    }


    public function Error(){
        return \View::make('/frontend/techonline/layouts/404',$this->ViewData);
    }

}
