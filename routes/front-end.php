<?php
Route::get('about', 'FrontEndController@about')->name('about');
Route::get('get-quote', 'FrontEndController@get_quote');
Route::post('get-quote', 'FrontEndController@get_quote_now');
//Route::get('track', 'FrontEndController@track_result');
Route::post('track', 'FrontEndController@track_result');
Route::get('contact-us', 'FrontEndController@contact_us');
Route::post('contact-us', 'FrontEndController@send_contact_us');
Route::get('request-pickup', 'FrontEndController@request_pickup');
Route::post('request-pickup', 'FrontEndController@update_request_pickup');
Route::get('faq', 'FrontEndController@faq');
Route::get('page/{slug?}', 'FrontEndController@show_page');
Route::get('news/{slug?}', 'FrontEndController@show_news');
Route::get('our-service/{slug?}', 'FrontEndController@show_service');
Route::get('support', 'FrontEndController@support');
Route::get('network', 'FrontEndController@network');
Route::get('career', 'FrontEndController@career');
Route::post('career', 'FrontEndController@post_career');
Route::get('find-location', 'FrontEndController@find_location');
Route::post('find-track', 'FrontEndController@find-track');