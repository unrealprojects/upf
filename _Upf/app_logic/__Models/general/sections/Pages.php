<?php
namespace UpfModels;

/*** Pages ***/
class Pages extends Meta{
    public $timestamps = false;
    protected $table = 'section_pages';
    public $Section = 'pages';
    public $Config = 'models/backend/sections/Pages';
}
