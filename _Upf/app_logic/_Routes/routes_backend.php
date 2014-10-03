<?php
/*** Auth ***/

Route::get('/backend/auth','\UpfControllers\AdministratorsController@Auth');
Route::group(['before'=>'csrf'],function(){
    Route::post('/backend/login','\UpfControllers\AdministratorsController@LogIn');
});

Route::group(['before'=>'administrators'], function(){
    /*** Auth ***/
    Route::get('/backend/logout','\UpfControllers\AdministratorsController@LogOut');

    /*** Sections ***/
    NewRoutesGroup([
        'articles',
        'pages',
        'users',
    ],'section');

    /*** Filters ***/
    NewRoutesGroup([
        'categories',
        'regions',
        'tags',
        'parameters',
    ],'filter');

    /*** System ***/
    NewRoutesGroup([
        'comments',
        'map',
        'files',
        'options',
        'controllers    '
    ],'system');



    /*** Home ***/
    Route::get('/backend/','\UpfControllers\HomeBackendController@index');

    /*** Documentation ***/
    Route::get('/backend/docs/cms','\UpfControllers\DocsController@PageCms');
    Route::get('/backend/docs/css','\UpfControllers\DocsController@PageCss');
    Route::get('/backend/docs/js','\UpfControllers\DocsController@PageJs');

    /*** Tests ***/
    Route::get('/backend/docs/testBackend','\UpfControllers\DocsController@PageTestBackend');
    Route::get('/backend/docs/testFrontend','\UpfControllers\DocsController@PageTestFrontend');
    Route::get('/backend/docs/test','\UpfControllers\DocsController@PageTest');

    /*** Administrators ***/

});