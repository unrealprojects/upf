<?php
namespace Controller\Frontend;

class FrontendController extends \Controller {

    public $viewData;

    public function __construct(){
        $this->getMetaData();
        $this->getBreadCrumbs();
    }

    public function getMetaData(){
        $alias=\Route::current()->parameter('alias');
        $Section=\Request::segment(1);

        $MetaData = \UpfModels\Meta::where('section',$Section)->where('alias',$alias)->first();

        $this->viewData=[
            'meta' => [
                'title' => (!empty($MetaData->title))?$MetaData->title:\Config::get('site/app_settings.MetaData.title'),
                'description' => (!empty($MetaData->description))?$MetaData->description:\Config::get('site.app_settings.metadata.description'),
                'keywords' => (!empty($MetaData->keywords))?$MetaData->keywords:\Config::get('site.app_settings.metadata.keyword')
            ]
        ];
    }

    public function getBreadCrumbs(){
        $Section=\Request::segment(1);
        $SectionName=\UpfModels\Meta::where('section',$Section)->where('alias','')->first();
        if($Section){
            $this->viewData['breadCrumbs']=[
                0=>[
                    'title'=>'Главная',
                    'link'=>'/'
                ],
                1=>[
                    'title'=>$Section->title,
                    'link'=>\Route::current()->parameter('alias')?'/'.$Section->section:'',
                ]
            ];
        }
        if($alias=\Route::current()->parameter('alias')){
            if($SectionItem = \UpfModels\Meta::where('section',$Section)->where('alias',$alias)->first()){
                $this->viewData['breadCrumbs'][2]=
                    [
                        'title'=>$SectionItem->title,
                        'link'=>''
                    ];
            }

        }
//        print_r($this->viewData['breadCrumbs']);


    }

}
