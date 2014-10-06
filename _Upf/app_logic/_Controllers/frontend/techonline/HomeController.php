<?php
namespace Controller\Frontend\TechOnline;

class MainPageController extends TechonlineController{

	public function index()
	{
        print_r(\UpfModels\Comments::max('wall_id'));
        exit;
        /* Фильтр */
        /* Новости, Исполнители с наивысшим рейтингом */

        $this->viewData['content']=[
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

        return \View::make($this->siteViewPath.'/layouts/MainPage',$this->viewData);
	}

    public function filterSet($category_alias){
        $paramFilters = new \UpfModels\Categories();
        $filters = $paramFilters->getFilters($category_alias);
        $this->viewData['content']=[
            'filters'=>$filters
        ];
        $content=\View::make($this->siteViewPath.'/layouts/filter/FilterParams',$this->viewData);
        $script=\View::make($this->siteViewPath.'/layouts/filter/FilterParamsScript',$this->viewData);
        echo json_encode([
            'params'=>[htmlentities($content)],
            'script'=>[htmlentities($script)],
        ]);
    }
}
