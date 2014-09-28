<?php
namespace Controller\Frontend;

class NewsController extends FrontendController{


    public function actionList(){
        /* ФИЛЬТРАЦИЯ */
        $filter = [
            'category' => \Input::get('category')?:false,
            'tag' => \Input::get('tag')?:false
        ];

        /* МОДЕЛЬ */
        $News = new \UpfModels\News();
        $NewsList=$News->getList($filter);
        $filters=false;
        if($filter['category']){
            $paramFilters = new \UpfModels\Categories();
            $filters = $paramFilters->getFilters($filter['category']);
        }

        /* ДАННЫЕ ВИД */
        $this->viewData['content'] = [
            'pagination' => $NewsList->links(),
            'list' => $NewsList->toArray()['data'],
            'template' => 'content',
            'tags' => \UpfModels\Tags::where('app_section','news')->get(),
            'filters' => $filters?:false
        ];

//        print_r($NewsList->toArray());
        return \View::make('/frontend/site_techonline/layouts/News',$this->viewData);
    }

    public function actionItem($alias){
        $News = new \UpfModels\News;
        $NewsItem=$News->getItem($alias);

        $this->viewData['content'] = [
            'item' => $NewsItem->toArray(),
            'template' => 'content',
        ];

        return \View::make('/frontend/site_techonline/layouts/NewsItem',$this->viewData);
    }
}
