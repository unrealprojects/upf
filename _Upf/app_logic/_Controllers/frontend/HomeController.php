<?php
namespace UpfFrontendControllers;

class HomeController extends FrontendController{
    public $View = '/frontend/techonline/layouts/Home';
    public $Model = '\UpfModels\Meta';
    public $BaseUrl = '/';

    public function Index(){
        /*** Default Model ***/
        $DefaultModel = new $this->Model();

        /*** Set Content ***/
        $this->ViewData['Content'] = $DefaultModel->FrontHome();

        return \View::make($this->View,$this->ViewData);
    }
}

/*

public function index()
{
    print_r(\UpfModels\Comments::max('wall_id'));
    exit;
    /* Фильтр */
    /* Новости, Исполнители с наивысшим рейтингом */
/*
    $this->ViewData['content']=[
        'filter'=>[
            'categories'=>\UpfModels\Categories::toSubCategories(true),
            'brands'=>\UpfModels\CatalogBrand::orderBy('foreign')->get()->toArray(),
            'categories_list'=>\UpfModels\Categories::all(),
            'regions'=>\UpfModels\CatalogRegion::toSubRegions(true),
            'regions_list'=>\UpfModels\CatalogRegion::all(),
            'type'=>'rent',
            'has_params'=>true,
        ],
        'categories'=>\UpfModels\Categories::toSubCategories(),
        'news'=>\UpfModels\Articles::orderBy('rating','desc')->with('tags','metadata')->limit(6)->get()->toArray(),
        'sellers'=>\UpfModels\CatalogAdmin::orderBy('rating','desc')->with('region','metadata')->limit(6)->get()->toArray()
    ];

    return \View::make($this->siteViewPath.'/layouts/MainPage',$this->ViewData);
}

public function filterSet($category_alias){
    $paramFilters = new \UpfModels\Categories();
    $filters = $paramFilters->getFilters($category_alias);
    $this->ViewData['content']=[
        'filters'=>$filters
    ];
    $content=\View::make($this->siteViewPath.'/layouts/filter/FilterParams',$this->ViewData);
    $script=\View::make($this->siteViewPath.'/layouts/filter/FilterParamsScript',$this->ViewData);
    echo json_encode([
        'params'=>[htmlentities($content)],
        'script'=>[htmlentities($script)],
    ]);
} */