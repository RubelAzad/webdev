<?php

Route::group(['middleware' => 'web', 'prefix' => 'service', 'namespace' => 'Modules\Service\Http\Controllers'], function()
{
    Route::get('/', 'ServiceController@index');
    Route::get('src-country/{code?}', 'ServiceController@src_country');
    Route::get('create/{provider_id?}', 'ServiceController@create');
    Route::get('create-src-country/{code?}', 'ServiceController@create_src_country');
    Route::get('edit/{id?}', 'ServiceController@edit');
    Route::post('update', 'ServiceController@update');
    Route::get('delete/{id?}', 'ServiceController@destroy');
    //Route::get('charge-setup', 'ServiceController@chargesetup');


    Route::get('provider/{id?}', 'ServiceController@provider');
    Route::get('create-provider', 'ServiceController@create_provider');
    Route::get('edit-provider/{id?}', 'ServiceController@edit_provider');
    Route::post('update-provider', 'ServiceController@update_provider');
    Route::get('delete-provider/{id?}', 'ServiceController@delete_provider');

    Route::get('valuable', 'ValuableController@index');
    Route::get('create-valuable', 'ValuableController@create');
    Route::get('edit-valuable/{id?}', 'ValuableController@edit');
    Route::post('update-valuable', 'ValuableController@update');
    Route::get('delete-valuable/{id?}', 'ValuableController@destroy');

    Route::post('get-dst-by-src', 'ServiceController@get_dst_country_by_src');

    Route::get('valuable', 'ValuableController@index');
    Route::get('create-valuable', 'ValuableController@create');
    Route::get('edit-valuable/{id?}', 'ValuableController@edit');
    Route::post('update-valuable', 'ValuableController@update');
    Route::get('delete-valuable/{id?}', 'ValuableController@destroy');

    Route::get('charge-setup', 'ChargeController@index');
    Route::post("charge-setup","ChargeController@addMorePost")->name('addmorePost');
    Route::get("charge-setup-list","ChargeController@chargelist");
    Route::get("/edit-charge/{name}","ChargeController@editcharge");

    Route::get('sharing-setup', 'SharingController@index');
    Route::post("sharing-setup","SharingController@sharestore")->name('sharestore');
    Route::get("share-setup-list","SharingController@sharelist");
    Route::get("/edit-share/{code}","SharingController@editshare");

    Route::get('customer-commission', 'CustomerCommissionController@index');
    Route::get("customer-commission",'CustomerCommissionController@comShare');
    Route::get('customer-commission/getstates/{id}','CustomerCommissionController@comShareName');
    Route::get('customer-commission/getcity/{id}','CustomerCommissionController@comShareCity');
    Route::get('customer-commission/getcurrency/{id}','CustomerCommissionController@comCountName');
    Route::get('customer-commission/getexchange/{id}','CustomerCommissionController@comExchangeName');
    Route::post("customer-commission","CustomerCommissionController@customerCommissionInsert")->name('customerCommissionInsert');
    Route::get("customer-commission-list","CustomerCommissionController@cutomerCommissionList");
    
    //Route::get('customer-commission/getstates/{id}','CustomerCommissionController@comName');
    //Route::get("customer-commission","CustomerCommissionController@comProvider");


    Route::get('commission-sharing', 'CommissionShareController@index');
    Route::get('commission-sharing','CommissionShareController@shareCommissionall');
    Route::get('commission-sharing/getexchange/{id}','CommissionShareController@shareExchangeName');
    Route::get('commission-sharing/getstates/{id}','CommissionShareController@shareCommFranCount');
    Route::get('commission-sharing/getcity/{id}','CommissionShareController@shareCommFranId');
    Route::post("commission-sharing","CommissionShareController@ShareCommissionInsert")->name('ShareCommissionInsert');
    Route::get("commission-sharing-list","CommissionShareController@shareCommissionList");
    //Route::get('commission-sharing/{id}','CommissionShareController@comName');
   



});
