<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('posts','PostsController');
Route::post('comments','PostsController@storeComment');
Route::post('register','PostsController@register');