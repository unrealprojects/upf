<?php
namespace UpfModels;

/*** Articles ***/
class Files extends Fields{
    public $timestamps = false;
    protected $table = 'system_files';
    public $Config = 'models/backend/sections/Files';
}