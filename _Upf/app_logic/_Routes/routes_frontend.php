<?php

/*** ARTICLES ***/
Route::get('/news','\Controller\Frontend\NewsController@actionList');
Route::get('/news/{alias}','\Controller\Frontend\NewsController@actionItem');


/*** VOTED ***/
Route::get('/vote/up/{app_section}/{id}','\Controller\VoteController@up');
Route::get('/vote/down/{app_section}/{id}','\Controller\VoteController@down');


/*** COMMENTS ***/
Route::get('/comments/add/{list_id}','\Controller\CommentsController@add');