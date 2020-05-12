<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'cargo', 'namespace' => 'Modules\Cargo\Http\Controllers'], function()
{
    Route::get('/', 'CargoController@index');
    Route::get('get-quote', 'CargoController@get_quote');
    Route::post('get-quote', 'CargoController@get_quote_from_providers');
    Route::get('get-line-for-quote/{i?}', 'CargoController@get_line_for_quote');
    Route::post('add-item-to-quote', 'CargoController@add_item_to_quote');

    Route::get('create/{id?}', 'CargoController@create');
    Route::get('draft', 'CargoController@draft');
    Route::get('delete-draft/{id?}', 'CargoController@delete_draft');
    Route::get('print-draft/{id?}', 'CargoController@print_draft');
    Route::get('track', 'CargoController@track');
    Route::get('import', 'CargoController@import');

    Route::post('create-sender', 'SenderController@store');
    Route::post('select-sender', 'SenderController@select_sender');
    Route::post('create-receiver', 'ReceiverController@store');
    Route::post('select-receiver', 'ReceiverController@select_receiver');
    Route::post('update-description', 'CargoController@update_description');
    Route::post('update-declare-value', 'CargoController@update_declare_value');
    Route::post('add-package', 'CargoController@add_package');
    Route::get('remove-package/{draft_id}/{row_id}', 'CargoController@remove_package');
    Route::post('add-declarable', 'CargoController@add_declarable');
    Route::get('remove-declarable/{draft_id}/{row_id}', 'CargoController@remove_declarable');
    Route::post('get-services', 'CargoController@get_services');
    Route::post('select-service', 'CargoController@select_service');
    Route::post('get-valuable-items-src-dts', 'CargoController@get_valuable_items_src_dts');
    Route::post('add-pickup-charge', 'CargoController@add_pickup_charge');
//    Route::post('get-insurance', 'CargoController@get_insurance');
//    Route::post('get-insurance-all', 'CargoController@get_insurance_all');
    Route::post('add-delivery', 'CargoController@add_delivery');
    Route::post('update-nearest-agent', 'CargoController@update_nearest_agent');
    Route::post('update-delivery', 'CargoController@update_delivery');
    Route::post('update-collection', 'CargoController@update_collection_point');
    Route::post('add-insurance', 'CargoController@add_insurance');
    Route::post('update-insurance', 'CargoController@update_insurance');
    Route::post('add-additional-packaging', 'CargoController@add_additional_packaging');
    Route::post('update-additional-packaging', 'CargoController@update_additional_packaging');
    Route::get('get-summary/{draft_id}', 'CargoController@get_summary');
    Route::post('get-post-basic-info', 'CargoController@get_post_basic_info');
    Route::post('update-discount', 'CargoController@update_discount');

    Route::post('get_agents_for_receiver', 'CargoController@get_agents_for_receiver');

    Route::get('pickup-booking', 'CargoController@pickup_booking');
    Route::post('submit-for-pickup', 'CargoController@submit_for_pickup');
    Route::get('confirmed-booking/{agent_id?}', 'CargoController@confirmed_booking');
    Route::post('assign-warehouse-pickup', 'CargoController@assign_warehouse_pickup');
    Route::get('assign-warehouse-pickup', 'CargoController@confirmed_booking');
});



