<?php

Route::get('/backend/','\Controller\Backend\FrontendController@index');

/*** Sections ***/
NewRoutesGroup([
    'articles',
    'pages',
    'users'
],'General','section');

/*** Filters ***/
NewRoutesGroup([
    'categories',
    'regions',
    'tags',
    'parameters',
],'General','filter');

/*** Default ***/
NewRoutesGroup([
    'comments',
    'map',
    'files',
    'options',
],'General','upf');


/*** Documentation ***/
Route::get('/backend/docs/cms','\UpfControllers\DocsController@PageCms');
Route::get('/backend/docs/css','\UpfControllers\DocsController@PageCss');
Route::get('/backend/docs/js','\UpfControllers\DocsController@PageJs');
/*** Tests ***/
Route::get('/backend/docs/testBackend','\UpfControllers\DocsController@PageTestBackend');
Route::get('/backend/docs/testFrontend','\UpfControllers\DocsController@PageTestFrontend');
Route::get('/backend/docs/test','\UpfControllers\DocsController@PageTest');