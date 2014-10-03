<?php
Route::group(['before'=>'administrators'], function(){
NewRoutesGroup([
    'catalog',
    'rent',
    'parts',
],'section');
});
