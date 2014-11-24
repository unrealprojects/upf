<?php

include 'app_logic/_Routes/routes_helper.php';
include 'app_logic/_Routes/routes_backend.php';
include 'app_logic/_Routes/routes_frontend.php';

include 'app_logic/_Routes/sites/routes_backend_techonline.php';
include 'app_logic/_Routes/sites/routes_frontend_techonline.php';


Route::get('/wind','Controller\Frontend\WindSpace\WindController@Index');
Route::get('/parse','Controller\Frontend\Excavator\ParserController@Index');