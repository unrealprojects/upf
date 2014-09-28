<?php
namespace Controller\Frontend\TechOnline;

class CatalogTechController extends TechonlineController{
    public function actionList()
    {
        /* ФИЛЬТРАЦИЯ */
        $filter = [
            'category' => \Input::get('category')?:false,
            'brands' => \Input::get('brands')?:false,
            'region' => \Input::get('region')?:false,
            'params' => \Input::get('params')?:false,
            'price-min' => \Input::get('price-min')?:false,
            'price-max' => \Input::get('price-max')?:false,
        ];

        /* МОДЕЛЬ */
        $modelCategories = new \UpfModels\Categories();
        $CatalogTech = new \UpfModels\CatalogTech();
        $CatalogTechList=$CatalogTech->getList($filter);
        $filters=false;
        if($filter['category']){
            $paramFilters = new \UpfModels\Categories();
            $filters = $paramFilters->getFilters($filter['category']);
        }


        /* ДАННЫЕ ВИД */
        $this->viewData['content'] = [
            'filter'=>[
                'categories'=>\UpfModels\Categories::toSubCategories(true),
                'brands'=>\UpfModels\CatalogBrand::orderBy('foreign')->get()->toArray(),
                'categories_list'=>\UpfModels\Categories::all(),
                'regions'=>\UpfModels\CatalogRegion::toSubRegions(true),
                'regions_list'=>\UpfModels\CatalogRegion::all(),
                'params'=>$modelCategories->getFilters(\Input::get('category')),
                'has_params'=>true,
                'has_price'=>true,
                'type'=>'rent'
            ],
            'pagination' => $CatalogTechList->appends(\Input::except('page'))->links(),
            'list' => $CatalogTechList->toArray()['data'],
            'template' => 'content',
            'categories' => \UpfModels\Categories::toSubCategories(),
            'brands' => \UpfModels\CatalogBrand::all()->toArray(),
            'regions' => \UpfModels\CatalogRegion::all()->toArray(),
            'filters' => $filters?:false
        ];
//        exit;
//        print_r( \DB::getQueryLog());exit;
//       print_r($this->viewData['content']['list']);exit;
        return \View::make($this->siteViewPath.'/layouts/CatalogTech',$this->viewData);
    }

    public function actionElement($alias)
    {
        /* ПОЛУЧЕНИЕ СПИСКА ДАННЫХ ИЗ КАТАЛОГА */
        $CatalogTech = new \UpfModels\CatalogTech;
        $CatalogTechElement=$CatalogTech->getElement($alias);

        $this->viewData['content'] = [
            'item' => $CatalogTechElement->toArray(),
            'template' => 'content'
        ];

        return \View::make($this->siteViewPath.'/layouts/CatalogTechElement',$this->viewData);
    }
}
