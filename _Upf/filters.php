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
    if(!Auth::check()){
        return Redirect::to('/backend/auth');
    }
});

/*** Only Users ***/
Route::filter('users', function()
{
    if(!Auth::check()){
        return Redirect::to('/auth');
    }
});