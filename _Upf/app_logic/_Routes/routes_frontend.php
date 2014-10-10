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

FrontendFullRoutes([
    'cabinet'
]);

/*** VOTED ***/
Route::get('/vote/up/{app_section}/{id}','\Controller\VoteController@Up');
Route::get('/vote/down/{app_section}/{id}','\Controller\VoteController@Down');

/*** COMMENTS ***/
Route::get('/comments/add/{list_id}','\Controller\CommentsController@Add');