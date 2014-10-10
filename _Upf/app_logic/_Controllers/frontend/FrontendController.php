<?php
namespace UpfFrontendControllers;

class FrontendController extends \Controller{
    /******************************************************************************************************************* Construct Frontend App ***/

    public $ViewData = [];
    public $View = '/frontend/techonline/layouts/Snippet/';
    public $Model = '\UpfModels\Fields';
    public $BaseUrl = '/';
    public $Template = 'frontend.techonline.content';
    public $TemplateRoot = 'frontend.techonline';
    public $User = [];

    public function __construct(){
        $this->ViewData = [
            /*** Default ***/
            'Model'             => $this->Model,
            'BaseUrl'           => $this->BaseUrl,
            /*** Template ***/
            'Template'          => $this->Template,
            'TemplateRoot'      => $this->TemplateRoot,
            'TemplateParts'     => $this->TemplateRoot . '.parts.',
            'TemplateLayouts'   => $this->TemplateRoot . '.layouts.',
            /*** Other ***/
        ];

        if(\Auth::users()->check()){
            $this->ViewData['user'] = \Auth::users()->getUser();
            $this->User = \Auth::users()->getUser();
            //print_r( $this->ViewData['user']);
        }
    }

    /******************************************************************************************************************* Default Frontend Functionality ***/

    /*** *** Index Action List *** ***/

    public function Index(){
        /*** Default Model ***/
        $DefaultModel = new $this->Model();

        /*** Set Content ***/
        $this->ViewData['Content'] = $DefaultModel->FrontIndex();

        /*** Show View ***/
        return \View::make($this->View . 'List' , $this->ViewData);
    }



    /*** *** Index Action List Item *** ***/

    public function Item($Alias){
        /*** Default Model ***/
        $DefaultModel = new $this->Model();

        /*** Set Content ***/
        $this->ViewData['Content'] = $DefaultModel->FrontItem($Alias);

        /*** Show View ***/
        return \View::make($this->View . 'Item' , $this->ViewData);
    }
}


/*
    public $viewData;

    public function __construct(){
      //  $this->getMetaData();
      //  $this->getBreadCrumbs();
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
*/