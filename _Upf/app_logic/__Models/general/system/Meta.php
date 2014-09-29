<?php

namespace UpfModels;

class Meta extends General {
    protected $table = 'system_meta';

    /*** Relations :: Tags :: Many To Many ***/
    public function Tags()
    {
        return $this->belongsToMany('UpfModels\Tags', 'filter_tags_to_items', 'item_id', 'tag_id');
    }

    /*** Relations :: Categories :: Has Many ***/
    public function Categories()
    {
        return $this->hasMany('UpfModels\Categories','id','category_id');
    }
}