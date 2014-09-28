<?php
namespace Controller\Frontend\TechOnline;

class CatalogPartsController extends TechonlineController{
    public function actionList()
    {
        /* ФИЛЬТРАЦИЯ */
        $filter = [
            'category' => \Input::get('category')?:false,
            'brand' => \Input::get('brand')?:false
        ];

        /* МОДЕЛЬ */
        $CatalogParts = new \UpfModels\CatalogParts();
        $CatalogPartsList=$CatalogParts->getList($filter);

        /* ДАННЫЕ ВИД */
        $this->viewData['content'] = [
            'pagination' => $CatalogPartsList->links(),
            'list' => $CatalogPartsList->toArray()['data'],
            'template' => 'content',
            'categories' => \UpfModels\Categories::toSubCategories(),
        ];
//        print_r($filters->toArray());exit;
        return \View::make($this->siteViewPath.'/layouts/CatalogParts',$this->viewData);
    }

    public function actionElement($alias)
    {
        /* ПОЛУЧЕНИЕ СПИСКА ДАННЫХ ИЗ КАТАЛОГА */
        $CatalogParts = new \UpfModels\CatalogParts;
        $CatalogPartsElement=$CatalogParts->getElement($alias);

        $this->viewData['content'] = [
            'item' => $CatalogPartsElement->toArray(),
            'template' => 'content'
        ];

        return \View::make($this->siteViewPath.'/layouts/CatalogPartsElement',$this->viewData);
    }
}
