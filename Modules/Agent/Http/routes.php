<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'agent', 'namespace' => 'Modules\Agent\Http\Controllers'], function()
{
    Route::get('/', 'AgentController@index');
    Route::get('create/{id?}', 'AgentController@create');
    Route::get('edit/{id?}', 'AgentController@edit');
    Route::get('view/{id}', 'AgentController@show');
    Route::post('update-business-info', 'AgentController@update_business_info');
    Route::post('add_new_officer', 'AgentController@add_new_officer');
    Route::post('get-employee', 'AgentController@get_employee');
    Route::post('update-employee', 'AgentController@update_employee');
    Route::get('delete-employee/{id}', 'AgentController@delete_employee');
    Route::post('update-contact-info', 'AgentController@update_contact_info');
    Route::post('update-business-rules', 'AgentController@update_business_rules');
    Route::post('add-document', 'AgentController@add_document');
    Route::get('delete-document/{id}', 'AgentController@delete_document');
    Route::post('confirm', 'AgentController@confirm');
    Route::post('change-status', 'AgentController@change_status');
    Route::get('delete/{id}', 'AgentController@delete');
    Route::post('change-service-status', 'AgentController@change_service_status');

    Route::get('account/{id?}', 'AccountController@index');
    Route::get('receive-payment', 'AccountController@receive_payment');
    Route::get('edit-payment/{id}', 'AccountController@edit_payment');
    Route::post('update-payment', 'AccountController@update_payment');
    Route::get('payment-history/{id?}', 'AccountController@payment_history');

    Route::get('agent_commission/{id?}', 'AccountController@agent_commission');
});
