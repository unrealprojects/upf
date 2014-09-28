<?php

/*** CATALOG ***/
Route::get('/','\Controller\Frontend\TechOnline\MainPageController@index');
Route::get('/filter/{category_alias}','\Controller\Frontend\TechOnline\MainPageController@filterSet');

Route::get('/catalog','\Controller\Frontend\TechOnline\CatalogController@actionList');
Route::get('/catalog/{alias}','\Controller\Frontend\TechOnline\CatalogController@actionElement');

/*** CATALOG_TECH ***/
Route::get('/rent','\Controller\Frontend\TechOnline\CatalogTechController@actionList');
Route::get('/rent/{alias}','\Controller\Frontend\TechOnline\CatalogTechController@actionElement');

/*** CATALOG_PARTS ***/
Route::get('/parts','\Controller\Frontend\TechOnline\CatalogPartsController@actionList');
Route::get('/parts/{alias}','\Controller\Frontend\TechOnline\CatalogPartsController@actionElement');

/*** CATALOG_SELLERS ***/
Route::get('/sellers','\Controller\Frontend\TechOnline\CatalogSellersController@actionList');
Route::get('/sellers/{alias}','\Controller\Frontend\TechOnline\CatalogSellersController@actionElement');


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
Route::post('/cabinet/{alias}/parts/{item_alias}/update','\Controller\Frontend\TechOn   line\CabinetController@actionUpdateParts');