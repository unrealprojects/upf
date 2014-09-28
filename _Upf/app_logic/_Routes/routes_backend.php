<?php

Route::get('/backend/','\Controller\Backend\FrontendController@index');

/*** Sections ***/
NewRoutesGroup([
    'articles',
    'pages',
],'General','section');

/*** Filters ***/
NewRoutesGroup([
    'categories',
    'regions',
    'tags',
    'parameters',
],'General','filters');

/*** Default ***/
NewRoutesGroup([
    'comments',
    'map',
    'files',
    'options',
],'General','upf');

/*** Documentation ***/
Route::get('/backend/docs/upf','\Controller\Backend\General\DocsController@index');