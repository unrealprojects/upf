<?php
namespace UpfControllers;

class BackendController extends UpfController {
    /******************************************************************************************************************* Construct Backend App ***/
    public $Upf_Interface = 'backend';


    public $View = '/general/layouts/Editing/';
    public $Model = '\UpfModels\Fields';
    public $BaseUrl = '/';
    public $Template = 'backend.standard.content';
    public $TemplateRoot = 'frontend.techonline';
    public $User = [];
    public $Filters = [];
    public $HasMeta = false;


        public function __construct(){


//            \SassCompiler::Make("scss/general/backend/main.scss", "css/backend/main.css");

            /*** Current Administrator ***/
                if($Administrator = \Auth::administrators()->getUser()){
                    $Login = $Administrator->login;
                }else{
                    $Login = false;
                }


            /*** Set ViewData ***/
            $this->ViewData = [
                /*** Default ***/
                'Model'                 =>      $this->Model,
                'BaseUrl'               =>      $this->BaseUrl,
                /*** Template ***/
                'Template'              =>      $this->Template,
                'TemplateRoot'          =>      $this->TemplateRoot,
                'TemplateParts'         =>      $this->TemplateRoot . '.parts.',
                'TemplateLayouts'       =>      $this->TemplateRoot . '.layouts.',

                /*** Other ***/
                'AdministratorLogin'    =>      $Login,
                'BreadCrumbs'           =>      $this->BreadCrumbs(),
                'Meta'                  =>      $this->Meta()
            ];
            parent::__construct();
        }




    /******************************************************************************************************************* Default Backend Functionality ***/



    /*** *** Get Meta Data *** ***/

        public function Meta(){

            $alias=\Route::current()->parameter('alias');
            $Section=\Request::segment(1);

            $Meta = \UpfModels\Meta::where('section',$Section)->where('alias',$alias)->first();

            return [
                    'title' => (!empty($Meta->title))?$Meta->title:\Config::get('site/app_settings.MetaTitle.content'),
                    'description' => (!empty($Meta->description))?$Meta->description:\Config::get('site/app_settings.MetaDescription.content'),
                    'keywords' => (!empty($Meta->keywords))?$Meta->keywords:\Config::get('site/app_settings.MetaKeywords.content')
            ];

        }





    /*** *** Bread Crumbs *** ***/

        public function BreadCrumbs(){

            $BreadCrumbs = [];

            /*** Backend ***/
                if(\Request::segment(1)=='backend'){

                    /*** Home ***/
                        $BreadCrumbs[0]['link'] = '/backend';
                        $BreadCrumbs[0]['title'] = 'Панель управления';

                    /*** Section Type ***/
                        if(\Request::segment(2)){
                            $Model = new \UpfModels\Components();
                            if($Destination = $Model->GetItemByAlias(\Request::segment(2))){
                                $BreadCrumbs[1]['alias'] = $Destination->alias;
                                $BreadCrumbs[1]['title'] = $Destination->title;
                            }
                        }

                    /*** Section ***/
                        if(\Request::segment(3)){
                            $Model = new \UpfModels\Components();
                            if($Destination = $Model->GetItemByAlias(\Request::segment(3))){
                                $BreadCrumbs[2]['link'] =
                                    $BreadCrumbs[0]['link'].'/'.$BreadCrumbs[1]['alias'].'/'.$Destination->alias;
                                $BreadCrumbs[2]['title'] = $Destination->title;
                            }
                        }
                }

            /*** Return BreadCrumbs ***/
                return $BreadCrumbs;
        }





}
