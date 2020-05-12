<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'post', 'namespace' => 'Modules\Post\Http\Controllers'], function()
{
    Route::get('/', 'PostController@index');
    Route::post('create', 'PostController@create_from_draft');
    Route::get('view/{tracking_no}', 'PostController@show');

    Route::get('get/{tracking_no}', 'PostController@get_post');

    Route::get('invoice/{id}', 'PostController@invoice');
    Route::get('label/{id}', 'PostController@label');

    Route::get('cancel/{tracking_no}', 'PostController@cancel_post');
});
