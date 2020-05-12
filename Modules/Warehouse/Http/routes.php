<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'warehouse', 'namespace' => 'Modules\Warehouse\Http\Controllers'], function()
{
    Route::get('/', 'WarehouseController@index');
    Route::get('show/{id}', 'WarehouseController@show');
    Route::get('add', 'WarehouseController@create');
    Route::get('edit/{id}', 'WarehouseController@edit');
    Route::post('update', 'WarehouseController@update');
    Route::get('delete/{id}', 'WarehouseController@destroy');

    Route::post('add-employee', 'WarehouseController@add_employee');
    Route::get('remove-employee/{id}', 'WarehouseController@remove_employee');

    Route::post('add-external-driver', 'WarehouseController@add_external_driver');
    Route::get('delete-external-driver/{id}', 'WarehouseController@delete_external_driver');
    Route::post('get-drivers', 'WarehouseController@get_drivers');
    Route::post('assign-pickup', 'WarehouseController@assign_pickup');
    Route::get('pickup-assigned', 'WarehouseController@pickup_assigned');
    Route::get('pickup-list/{id}', 'WarehouseController@pickup_list');
    Route::get('print-pickup-list/{id}', 'WarehouseController@print_pickup_list');

    Route::get('entries', 'EntryController@index');
    Route::get('get-post/{tracking_no}', 'EntryController@get_post');
    Route::get('add-entry', 'EntryController@create');
    Route::post('add-entry', 'EntryController@store');
//    Route::get('get-entry/{tracking_no}', 'EntryController@get_post');

    Route::get('login/{id?}', 'WarehouseController@login');
    Route::get('logout', 'WarehouseController@logout');

});
