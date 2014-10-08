<?php

FrontendRoutes([
    /*** Tech Online ***/
    'catalog',
    'rent',
    'parts'
]);



/*** CABINET ***/
Route::get('/cabinet/{alias}/','\Controller\Frontend\TechOnline\CabinetController@actionCabinet');
Route::post('/cabinet/{alias}/add','\Controller\Frontend\TechOnline\CabinetController@actionAdd');
Route::get('/cabinet/{alias}/update','\Controller\Frontend\TechOnline\CabinetController@actionUpdate');
Route::get('/cabinet/{alias}/rent','\Controller\Frontend\TechOnline\CabinetController@actionRentList');
Route::get('/cabinet/{alias}/parts','\Controller\Frontend\TechOnline\CabinetController@actionPartsList');
Route::post('/cabinet/{alias}/rent/add','\Controller\Frontend\TechOnline\CabinetController@actionAddRent');
Route::post('/cabinet/{alias}/parts/add','\Controller\Frontend\TechOnline\CabinetController@actionAddParts');
Route::get('/cabinet/{alias}/rent/{item_alias}/','\Controller\Frontend\TechOnline\CabinetController@actionEditRent');
Route::get('/cabinet/{alias}/parts/{item_alias}/','\Controller\Frontend\TechOnline\CabinetController@actionEditParts');
Route::post('/cabinet/{alias}/rent/{item_alias}/update','\Controller\Frontend\TechOnline\CabinetController@actionUpdateRent');
Route::post('/cabinet/{alias}/parts/{item_alias}/update','\Controller\Frontend\TechOnline\CabinetController@actionUpdateParts');