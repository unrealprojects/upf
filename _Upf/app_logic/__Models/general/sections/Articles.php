<?php
namespace UpfModels;

/*** Articles ***/
class Articles extends Meta{
    public $timestamps = false;
    protected $table = 'section_articles';
    public $Section = 'articles';
    public $PhotosUrl = '/photo/standard/sections/articles/';
}