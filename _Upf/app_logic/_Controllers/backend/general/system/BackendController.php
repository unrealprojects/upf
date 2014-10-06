<?php
namespace UpfControllers;

class BackendController extends \Controller {

    public $viewData;
    public $BaseUrl;
    public $Model='\UpfModels\\';

    public function __construct(){
        $Administrator = \Auth::getUser();
        $this->viewData['Model']=$this->Model;
        if($Administrator){
            $this->viewData['AdministratorLogin']=$Administrator->login;
        }
        $this->viewData['BaseUrl'] = $this->BaseUrl;
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
        $Section=\Request::segment(1);

        $Meta = \UpfModels\Meta::where('section',$Section)->where('alias',$alias)->first();

        $this->viewData['meta'] = [
                'title' => (!empty($Meta->title))?$Meta->title:\Config::get('site/app_settings.MetaTitle.content'),
                'description' => (!empty($Meta->description))?$Meta->description:\Config::get('site/app_settings.MetaDescription.content'),
                'keywords' => (!empty($Meta->keywords))?$Meta->keywords:\Config::get('site/app_settings.MetaKeywords.content')
        ];
    }

    public function getBreadCrumbs(){

        if(\Request::segment(1)=='backend'){
            $this->viewData['BreadCrumbs'][0]['link'] = '/backend';
            $this->viewData['BreadCrumbs'][0]['title'] = 'Панель управления';

            if(\Request::segment(2)){
                $Model = new \UpfModels\Components();
                if($Destination = $Model->GetItemByAlias(\Request::segment(2))){
                    $this->viewData['BreadCrumbs'][1]['alias'] = $Destination->alias;
                    $this->viewData['BreadCrumbs'][1]['title'] = $Destination->title;
                }
            }
            if(\Request::segment(3)){
                $Model = new \UpfModels\Components();
                if($Destination = $Model->GetItemByAlias(\Request::segment(3))){
                    $this->viewData['BreadCrumbs'][2]['link'] =
                        $this->viewData['BreadCrumbs'][0]['link'].'/'.$this->viewData['BreadCrumbs'][1]['alias'].'/'.$Destination->alias;
                    $this->viewData['BreadCrumbs'][2]['title'] = $Destination->title;
                }
            }
        }

        //print_r($this->viewData['BreadCrumbs']);






        /*
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
        }*/
    }
}
