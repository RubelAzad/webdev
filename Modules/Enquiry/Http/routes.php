<?php

Route::group(['middleware' => 'web', 'prefix' => 'enquiry', 'namespace' => 'Modules\Enquiry\Http\Controllers'], function()
{
    Route::get('/', 'EnquiryController@index');
    Route::get('create', 'EnquiryController@create');
    Route::post('update', 'EnquiryController@update');
    Route::get('inbox', 'EnquiryController@incoming_enquiries');
    Route::get('sent', 'EnquiryController@sent_enquiries');
    Route::get('internal-show/{id?}', 'EnquiryController@internal_show');
    Route::post('internal-reply', 'EnquiryController@internal_reply');
    Route::post('internal-update-status', 'EnquiryController@internal_update_status');
    Route::get('agent', 'EnquiryController@agent_enquiries');
    Route::get('show/{id?}', 'EnquiryController@show');
    Route::get('view/{link?}', 'EnquiryController@view');
    Route::post('assign_to_agent', 'EnquiryController@assign_to_agent');
    Route::post('reply', 'EnquiryController@reply');

    Route::get('subject', 'SubjectController@index');
    Route::post('subject-update', 'SubjectController@update');
    Route::get('subject-get/{id}', 'SubjectController@get_subject');
    Route::get('subject-delete/{id}', 'SubjectController@destroy');
});
