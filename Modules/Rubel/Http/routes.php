<?php

Route::group(['middleware' => 'web', 'prefix' => 'rubel', 'namespace' => 'Modules\Rubel\Http\Controllers'], function()
{
    Route::get('/', 'RubelController@index');
});
