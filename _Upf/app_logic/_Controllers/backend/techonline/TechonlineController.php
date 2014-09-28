<?php
namespace Controller\Backend\TechOnline;

class TechonlineController extends \Controller{

    public $viewData;
    public $siteViewPath='/backend/site_techonline/';

    public function __construct(){
        $this->getMetaData();
    }

    public function getMetaData(){
        $this->viewData=[
            'meta' => [
                'title' => 'Hardcore',
                'description' => 'Hardcore cms',
                'keywords' => 'Hardcore,cms    '
            ]
        ];
    }

}