<?php
namespace UpfControllers;

class CommentsController extends FieldsController{
    public $Upf_Page_Section = 'comments';

    public $BaseUrl = '/backend/system/comments/';
    public $Model = '\UpfModels\Comments';
}
