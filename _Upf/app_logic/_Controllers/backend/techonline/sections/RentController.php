<?php
namespace UpfControllers;

class RentController extends SectionsController{
    public $Upf_Page_Section = 'rent';

    public $BaseUrl = '/backend/section/rent/';
    public $Model = '\UpfModels\Rent';
    public $HasMeta = true;
}

