<?php
namespace UpfControllers;

class BackendController extends \Controller {

    public $viewData;

    public function __construct(){
        $this->getMeta();
        $this->getBreadCrumbs();
        $this->setTemplate();
    }

    /*** Set Default Template
            * You can change it in CustomController
     ***/
    public function setTemplate(){
        $this->viewData['template']='backend.standard.content';
    }

    public function getMeta(){
        $alias=\Route::current()->parameter('alias');
        $app_section=\Request::segment(1);

        $MetaData = \UpfModels\Meta::where('section',$app_section)->where('alias',$alias)->first();

        $this->viewData=[
            'meta' => [
                'title' => (!empty($MetaData->title))?$MetaData->title:\Config::get('site/app_settings.MetaData.title'),
                'description' => (!empty($MetaData->description))?$MetaData->description:\Config::get('site.app_settings.metadata.description'),
                'keywords' => (!empty($MetaData->keywords))?$MetaData->keywords:\Config::get('site.app_settings.metadata.keyword')
            ]
        ];
    }

    public function getBreadCrumbs(){
        $app_section=\Request::segment(1);
        $app_section_name=\UpfModels\Meta::where('section',$app_section)->where('alias','')->first();
        if($app_section_name){
            $this->viewData['breadCrumbs']=[
                0=>[
                    'title'=>'Главная',
                    'link'=>'/'
                ],
                1=>[
                    'title'=>$app_section_name->title,
                    'link'=>\Route::current()->parameter('alias')?'/'.$app_section_name->app_section:'',
                ]
            ];
        }
        if($alias=\Route::current()->parameter('alias')){
            if($app_section_item = \UpfModels\Meta::where('section',$app_section)->where('alias',$alias)->first()){
                $this->viewData['breadCrumbs'][2]=
                    [
                        'title'=>$app_section_item->title,
                        'link'=>''
                    ];
            }
        }
    }
}
