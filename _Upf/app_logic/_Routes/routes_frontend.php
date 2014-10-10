<?php

/*** Home ***/
Route::get('/','\UpfFrontendControllers\HomeController@Index');

/*** Sections ***/
FrontendRoutes([
    /*** General ***/
    'articles',
    'pages',
    'users',
]);





/*** Auth ***/
Route::group(['before'=>'csrf'],function(){
    Route::post('/login','\UpfFrontendControllers\UsersController@LogIn');
    Route::post('/register','\UpfFrontendControllers\UsersController@Register');
});

/*** User Cabinet ***/

Route::group(['before'=>'users'], function(){
    Route::get('/backend/logout','\UpfFrontendControllers\UsersController@LogOut');

    FrontendFullRoutes([
        'cabinet'
    ]);
});




/*** VOTED ***/
Route::get('/vote/up/{section}/{id}','\Controller\VoteController@Up');
Route::get('/vote/down/{section}/{id}','\Controller\VoteController@Down');

/*** COMMENTS ***/
Route::get('/comments/add/{list_id}','\Controller\CommentsController@Add');