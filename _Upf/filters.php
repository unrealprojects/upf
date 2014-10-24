<?php


App::before(function($request)
{
    //
});


App::after(function($request, $response)
{
    //
});



Route::filter('csrf', function()
{
    if (Session::token() != Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});


/*** Only Administrators ***/
Route::filter('administrators', function()
{

    if(!Auth::administrators()->check()){
        return Redirect::to('/backend/auth');
    }
});

/*** Only Users ***/
Route::filter('users', function()
{
    if(!Auth::users()->check()){
        return Redirect::to('/');
    }
});