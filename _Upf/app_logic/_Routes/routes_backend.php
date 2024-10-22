<?php
/*** Auth ***/
    Route::get('/backend/auth','\UpfControllers\AdministratorsController@Auth');

    Route::group(['before'=>'csrf'],function(){
        Route::post('/backend/login','\UpfControllers\AdministratorsController@LogIn');
    });


Route::group(['before'=>'administrators'], function(){

    /*** Auth ***/

        Route::get('/backend/logout','\UpfControllers\AdministratorsController@LogOut');

    /*** Home ***/

        Route::get('/backend/','\UpfControllers\HomeBackendController@index');

    /*** Sections ***/

        BackendRoutes([
            'articles',
            'pages',
            'users',
        ],'section');

    /*** Filters ***/

        BackendRoutes([
            'categories',
            'regions',
            'tags',
            'params'
        ],'filter');

    /*** System ***/

        BackendRoutes([
            'administrators',
            'meta',
            'fields',
            'comments',
            'components',
            'files',
            'options',
            'controllers'
        ],'system');




    /*** Settings ***/

        Route::get('/backend/system/settings/','\UpfControllers\SettingsController@index');
        Route::post('/backend/system/settings/update','\UpfControllers\SettingsController@update');

    /*** Documentation ***/

        Route::get('/backend/docs/cms','\UpfControllers\DocsController@PageCms');
        Route::get('/backend/docs/css','\UpfControllers\DocsController@PageCss');
        Route::get('/backend/docs/js','\UpfControllers\DocsController@PageJs');

    /*** Tests ***/

        Route::get('/backend/docs/testBackend','\UpfControllers\DocsController@PageTestBackend');
        Route::get('/backend/docs/testFrontend','\UpfControllers\DocsController@PageTestFrontend');
        Route::get('/backend/docs/test','\UpfControllers\DocsController@PageTest');


});