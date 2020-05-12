<?php

Route::group(['middleware' => 'web', 'prefix' => 'shipment', 'namespace' => 'Modules\Shipment\Http\Controllers'], function()
{
    Route::get('/', 'ShipmentController@index');

    Route::get('hawb', 'ShipmentController@hawb');
    Route::get('hawb/{id}', 'ShipmentController@show_hawb');
    Route::get('create-hawb', 'ShipmentController@create_hawb');
    Route::post('update-hawb', 'ShipmentController@update_hawb');
    Route::get('delete-hawb/{id?}', 'ShipmentController@delete_hawb');
    Route::get('get-hawb/{id}', 'ShipmentController@get_hawb');
    Route::post('add-post-to-hawb', 'ShipmentController@add_post_to_hawb');

    Route::get('mawb', 'ShipmentController@mawb');
    Route::get('mawb/{id}', 'ShipmentController@show_mawb');
    Route::get('create-mawb', 'ShipmentController@create_mawb');
    Route::post('update-mawb', 'ShipmentController@update_mawb');

});
