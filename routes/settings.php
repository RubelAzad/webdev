<?php

Route::group(['prefix' => 'settings', 'middleware' => 'auth'], function(){
    Route::get('/', 'SettingsController@index');
    Route::post('update-package', 'SettingsController@update_package');
    Route::post('update-billing', 'SettingsController@update_billing');
    Route::get('status', 'SettingsController@show_status');

    Route::get('package-type', 'SettingsController@show_package_type');
    Route::get('package-type-get/{id}', 'SettingsController@package_type_get');
    Route::get('package-type-delete/{id}', 'SettingsController@package_type_delete');
    Route::post('package-type-update', 'SettingsController@update_package_type');

});

