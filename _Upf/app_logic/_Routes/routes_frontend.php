<?php

/*** Home ***/

    Route::get('/','\UpfFrontendControllers\HomeController@Index');
    Route::get('/sitemap.xml','\UpfFrontendControllers\HomeController@SiteMap');


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

    Route::group(['before'=>'users'], function(){
        Route::get('/logout','\UpfFrontendControllers\UsersController@LogOut');
        FrontendCabinetRoutes(['cabinet']);
    });




/*** VOTED ***/

    Route::post('/vote/','\UpfFrontendControllers\VoteController@Vote');

/*** COMMENTS ***/

    Route::any('/comments/','\UpfFrontendControllers\CommentsController@Add');

/*** Error ***/
  //  Route::get('/error','\UpfFrontendControllers\HomeController@Error');

