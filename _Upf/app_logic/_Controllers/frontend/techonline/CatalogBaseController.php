<?php
namespace Controller\Frontend\TechOnline;

class CatalogController extends TechonlineController{
    public function actionList()
    {
        /* ФИЛЬТРАЦИЯ */
        $filter = [
            'category' => \Input::get('category')?:false,
            'brands' => \Input::get('brands')?:false,
            'params' => \Input::get('params')?:false,
            'price-min' => \Input::get('price-min')?:false,
            'price-max' => \Input::get('price-max')?:false,
        ];

        /* МОДЕЛЬ */
        $modelCategories = new \UpfModels\Categories();
        $Catalog = new \UpfModels\Catalog();
        $CatalogList=$Catalog->getList($filter);
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
                'params'=>$modelCategories->getFilters(\Input::get('category')),
                'has_params'=>true,
                'has_price'=>false,
                'type'=>'catalog'
            ],
            'pagination' => $CatalogList->links(),
            'list' => $CatalogList->toArray()['data'],
            'template' => 'content',
            'categories' => \UpfModels\Categories::toSubCategories(),
            'brands' => \UpfModels\CatalogBrand::all()->toArray(),
            'filters' => $filters?:false
        ];
//        print_r($CatalogList->toArray()['data']);exit;
        return \View::make($this->siteViewPath.'/layouts/Catalog',$this->viewData);
    }

    public function actionElement($alias)
    {
        /* ПОЛУЧЕНИЕ СПИСКА ДАННЫХ ИЗ КАТАЛОГА */
        $Catalog = new \UpfModels\Catalog;
        $CatalogElement=$Catalog->getElement($alias);

        $this->viewData['content'] = [
            'item' => $CatalogElement->toArray(),
            'template' => 'content',
        ];

        exit;
        return \View::make($this->siteViewPath.'/layouts/CatalogElement',$this->viewData);
    }

}
