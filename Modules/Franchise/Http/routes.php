<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'franchise', 'namespace' => 'Modules\Franchise\Http\Controllers'], function()
{
    Route::get('/', 'FranchiseController@index');
    Route::get('create/{id?}', 'FranchiseController@create');
    Route::get('edit/{id?}', 'FranchiseController@edit');
    Route::get('view/{id}', 'FranchiseController@show');
    Route::post('update-business-info', 'FranchiseController@update_business_info');
    Route::post('add_new_officer', 'FranchiseController@add_new_officer');
    Route::post('get-employee', 'FranchiseController@get_employee');
    Route::post('update-employee', 'FranchiseController@update_employee');
    Route::get('delete-employee/{id}', 'FranchiseController@delete_employee');
    Route::post('update-contact-info', 'FranchiseController@update_contact_info');
    Route::post('update-business-rules', 'FranchiseController@update_business_rules');
    Route::post('add-document', 'FranchiseController@add_document');
    Route::get('delete-document/{id}', 'FranchiseController@delete_document');
    Route::post('confirm', 'FranchiseController@confirm');
    Route::post('change-status', 'FranchiseController@change_status');
    Route::get('delete/{id}', 'FranchiseController@delete');
    Route::post('get', 'FranchiseController@get');

    Route::get('agents', 'FranchiseController@agents');
});
