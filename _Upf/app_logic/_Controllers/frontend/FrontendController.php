<?php
namespace UpfFrontendControllers;

class FrontendController extends \UpfControllers\UpfController {
    /******************************************************************************************************************* Construct Frontend App ***/

    public $ViewData =          [];
    public $View =              '/frontend/techonline/layouts/Snippet/';
    public $Model =             '\UpfModels\Fields';
    public $BaseUrl =           '/';
    public $Template =          'frontend.techonline.content';
    public $TemplateRoot =      'frontend.techonline';
    public $TemplateParts =     'frontend.techonline.parts.';
    public $TemplateLayouts =   'frontend.techonline.layouts.';
    public $TemplateModules =   'frontend.techonline.modules.';
    public $User = [];
    public $HasMeta = false;

    public function __construct(){
        parent::__construct();
        \SassCompiler::Make("scss/general/frontend/techonline/main.scss", "css/frontend/techonline/main.css");

        $this->ViewData = [
            /*** Default ***/
            'Model'             => $this->Model,
            'BaseUrl'           => $this->BaseUrl,
            /*** Template ***/
            'Template'          => $this->Template,
            'TemplateRoot'      => $this->TemplateRoot,
            'TemplateParts'     => $this->TemplateParts,
            'TemplateLayouts'   => $this->TemplateLayouts,
            'TemplateModules'   => $this->TemplateModules,
            /*** Other ***/
            'Modules'           => $this->Modules()
        ];

        /*** User Data ***/
        if(\Auth::users()->check()){
            $this->ViewData['user'] = \Auth::users()->getUser();
            $this->User = \Auth::users()->getUser();
        }

        //print_r($this->ViewData['user']);
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

    /*** *** Set Default Modules *** ***/
    public function Modules(){
        return [];
    }
}


/*
    public $ViewData;

    public function __construct(){
      //  $this->getMetaData();
      //  $this->getBreadCrumbs();
    }

    public function getMetaData(){
        $alias=\Route::current()->parameter('alias');
        $Section=\Request::segment(1);

        $MetaData = \UpfModels\Meta::where('section',$Section)->where('alias',$alias)->first();

        $this->ViewData=[
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
            $this->ViewData['breadCrumbs']=[
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
                $this->ViewData['breadCrumbs'][2]=
                    [
                        'title'=>$SectionItem->title,
                        'link'=>''
                    ];
            }

        }
//        print_r($this->ViewData['breadCrumbs']);


    }
*/