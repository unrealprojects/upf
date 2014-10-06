<?php
namespace UpfModels;

/*** Parts ***/
class Parts extends Meta{
    public $timestamps = false;
    protected $table = 'section_parts';
    public $Section = 'parts';
    public $PhotosUrl = '/photo/standard/sections/parts/';
}
