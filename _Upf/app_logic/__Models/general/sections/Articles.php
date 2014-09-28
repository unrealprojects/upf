<?php
namespace UpfModels;

/*** Articles ***/
class Articles extends General{
    public $timestamps = false;
    protected $table = 'section_articles';

    /*** Tags :: Many To Many ***/
    public function Tags()
    {
          return $this->belongsToMany('UpfModels\Tags', 'filter_tags_to_items', 'item_id', 'tag_id');
    }

    /*** Categories :: Has Many ***/
    public function Categories()
    {
        return $this->hasMany('UpfModels\Categories','id','category_id');
    }

    /* Запросы */
    public function GetList($filter){
        $this->filter = $filter;

        return $this->with('category','meta','tags')
            ->whereHas('tags', function($query) {
                if($this->filter['tag']){
                    $query->where('alias', $this->filter['tag']);
                }
            })
            ->paginate(5);
    }

    public function GetItem($alias){
        $this->rewrite['alias']=$alias;
        return $this->with('category','meta','tags','comments')
            ->whereHas('meta', function($query) {
                $query->where('alias',$this->rewrite['alias']);
            })
            ->first();
    }

    /*** Get List for Backend***/
    public function Index(){
        //Set Relations
        $Query = $this::with(
            'meta',
            // Filters
            'categories','tags');
        $Query = $Query->paginate(isset($Filter['PageSize'])?$Filter['PageSize']:20);
        return [
            'list' => $Query->toArray()['data'],
            'fields' =>\Config::get('models/backend/sections/Articles.list'),
            'pagination' => $Query->appends(\Input::except('page'))->links(),
        ];
    }

    /*** Where Has Meta ***/
    public function GetMeta($Query){
        return $Query->whereHas('metadata', function($SubQuery) {
            $SubQuery->where('alias',$this->rewrite['alias']);
        });
    }

    /*** Remove Item ***/
    public function Remove($alias){
        $this->rewrite['alias']=$alias;
        //$Query = $this::with('metadata','categories','tags');
          $Query = $this->aMetadata($this)->with('metadata','categories','tags');
        return $Query->delete();
    }

}
