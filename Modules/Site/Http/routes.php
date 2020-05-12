<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'site', 'namespace' => 'Modules\Site\Http\Controllers'], function()
{
    Route::get('/', 'SiteController@index');

    Route::post('page/update', 'PageController@update');
    Route::get('page', 'PageController@index');
    Route::get('page/add-new', 'PageController@create');
    Route::get('page/edit/{id?}', 'PageController@edit');
    Route::get('page/delete/{id?}', 'PageController@destroy');
    Route::get('page/featured/{id?}', 'PageController@featured');

    Route::post('feed/update', 'FeedController@update');
    Route::get('feed', 'FeedController@index');
    Route::get('feed/add-new', 'FeedController@create');
    Route::get('feed/edit/{id?}', 'FeedController@edit');
    Route::get('feed/delete/{id?}', 'FeedController@destroy');

    Route::post('news/update', 'NewsController@update');
    Route::get('news', 'NewsController@index');
    Route::get('news/add-new', 'NewsController@create');
    Route::get('news/edit/{id?}', 'NewsController@edit');
    Route::get('news/delete/{id?}', 'NewsController@destroy');

    Route::post('partner/update', 'PartnerController@update');
    Route::get('partner', 'PartnerController@index');
    Route::get('partner/add-new', 'PartnerController@create');
    Route::get('partner/edit/{id?}', 'PartnerController@edit');
    Route::get('partner/delete/{id?}', 'PartnerController@destroy');

    Route::post('service/update', 'ServiceController@update');
    Route::get('service', 'ServiceController@index');
    Route::get('service/add-new', 'ServiceController@create');
    Route::get('service/edit/{id?}', 'ServiceController@edit');
    Route::get('service/delete/{id?}', 'ServiceController@destroy');

    Route::post('slide-show/update', 'SlideShowController@update');
    Route::get('slide-show', 'SlideShowController@index');
    Route::get('slide-show/add-new', 'SlideShowController@create');
    Route::get('slide-show/edit/{id?}', 'SlideShowController@edit');
    Route::get('slide-show/delete/{id?}', 'SlideShowController@destroy');
    Route::get('slide-show/show-info/{id?}', 'SlideShowController@show_info');

    Route::post('testimonial/update', 'TestimonialController@update');
    Route::get('testimonial', 'TestimonialController@index');
    Route::get('testimonial/add-new', 'TestimonialController@create');
    Route::get('testimonial/edit/{id?}', 'TestimonialController@edit');
    Route::get('testimonial/delete/{id?}', 'TestimonialController@destroy');

    Route::post('faq/update', 'FaqController@update');
    Route::get('faq', 'FaqController@index');
    Route::get('faq/add-new', 'FaqController@create');
    Route::get('faq/edit/{id?}', 'FaqController@edit');
    Route::get('faq/delete/{id?}', 'FaqController@destroy');

    Route::post('faq-cat/update', 'FaqController@cat_update');
    Route::get('faq-cat', 'FaqController@cat_index');
    Route::get('faq-cat/add-new', 'FaqController@cat_create');
    Route::get('faq-cat/edit/{id?}', 'FaqController@cat_edit');
    Route::get('faq-cat/delete/{id?}', 'FaqController@cat_destroy');

    Route::get('settings', 'SiteController@settings');
    Route::post('settings/update', 'SiteController@settings_update');


    //Route::get('contact', 'ContactController@index');
    //Route::get('contact/add-new', 'ContactController@create');

    Route::get('contact', 'ContactController@ServiceIndex');
    Route::get('/getServicesData', 'ContactController@getServiceData');
    Route::post('/ServiceDelete', 'ContactController@ServiceDelete');
    Route::post('/ServiceDetails', 'ContactController@getServiceDetails');
    Route::post('/ServiceUpdate', 'ContactController@ServiceUpdate');
    Route::post('/ServiceAdd', 'ContactController@ServiceAdd');
});
