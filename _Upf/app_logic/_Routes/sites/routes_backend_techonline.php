<?php
Route::group(['before'=>'administrators'], function(){

    BackendRoutes([
        'catalog',
        'rent',
        'parts',
    ],'section');

});
