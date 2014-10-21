<?php
namespace UpfControllers;

class UsersController extends SectionsController{
    public $Upf_Page_Section = 'users';

    public $BaseUrl = '/backend/section/users/';
    public $Model = '\UpfModels\Users';
    public $HasMeta = true;
}