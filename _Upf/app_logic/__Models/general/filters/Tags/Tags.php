<?php

namespace UpfModels;

class Tags extends Fields{
    protected $table = 'filter_tags';
    public $PhotosUrl = '/photo/standard/filters/tags/';
    public $timestamps = true;
}
