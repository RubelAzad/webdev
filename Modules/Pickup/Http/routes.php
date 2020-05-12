<?php

Route::group(['middleware' => 'web', 'prefix' => 'pickup', 'namespace' => 'Modules\Pickup\Http\Controllers'], function()
{
    Route::get('/', 'PickupController@index');
    Route::get('history', 'PickupController@history');
    Route::get('view/{id}', 'PickupController@show');
    Route::post('assign-agent', 'PickupController@assign_agent');
    Route::get('agent', 'PickupController@pickup_request_to_agent');
});
