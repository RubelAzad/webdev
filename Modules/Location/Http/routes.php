<?php

Route::group(['middleware' => 'web', 'prefix' => 'location', 'namespace' => 'Modules\Location\Http\Controllers'], function()
{
    Route::get('/', 'LocationController@index');
    Route::get('countries', 'LocationController@countries');
    Route::get('find-us', 'LocationController@find_us');

    Route::get('get_hint', 'LocationController@get_location_hint');
});

Route::group(['middleware' => 'web', 'prefix' => 'country', 'namespace' => 'Modules\Location\Http\Controllers'], function()
{
    Route::get('/', 'LocationController@countries');
    Route::get('view/{code}', 'LocationController@country');
    Route::get('view-vat/{code}', 'LocationController@country_vat');
    Route::post('update-vat', 'LocationController@update_vat');
});

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'zone', 'namespace' => 'Modules\Location\Http\Controllers'], function()
{
    Route::get('/', 'ZoneController@index');
    Route::get('create', 'ZoneController@create');
    Route::post('create', 'ZoneController@update');
    Route::get('edit/{id}', 'ZoneController@edit');
    Route::get('delete/{id?}', 'ZoneController@destroy');
});
