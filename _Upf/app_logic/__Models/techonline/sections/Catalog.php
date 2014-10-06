<?php
namespace UpfModels;

class Catalog extends Meta {
    public $timestamps = false;
    protected $table = 'section_catalog';
    public $Section = 'catalog';
    public $PhotosUrl = '/photo/standard/sections/catalog/';
}