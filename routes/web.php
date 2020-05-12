<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontEndController@index');
Route::get('home', 'DashboardController@index')->name('home');
Route::get('dashboard', 'DashboardController@index')->name('dashboard');

Auth::routes();
Route::get('/register-done', function (){
    Auth::logout();
    return view('register-done');
});

Route::get('verify/{token?}', function ($token=''){

    if(! $token){
        return 'token not found';
    }

    $user = \App\User::where('verify_token', $token)->get()->first();

    if(! $user){
        return 'User not found!';
    }

    if($user->verified){
        return 'The link is expired!';
    }

    $user->active = 1;
    $user->verified = 1;

    if($user->save()){
        // now assign guest role to this user
        $role = \App\Role::where('name', 'User')->get()->first();
        $user->roles()->attach($role->id);
    }

    return view('verify');
});

Route::get('user/all', 'UserController@index');
Route::get('users', 'UserController@index');
Route::get('user/view/{id?}', 'UserController@show');
Route::get('user/edit/{id?}', 'UserController@edit_user');
Route::post('user/edit/{id?}', 'UserController@update_user');
Route::post('user/change-password', 'UserController@change_password');
Route::post('user/change-status', 'UserController@change_status');
Route::get('user/delete/{id}', 'UserController@delete');
Route::get('login_as/{id?}','UserController@login_as');
Route::get('back_to_my_account','UserController@back_to_original_user');
Route::get('user/add-new/{role?}', 'UserController@add_new_user');
Route::post('user/add-new', 'UserController@insert_new_user');
Route::post('user/get-one-ajax', 'UserController@get_user_ajax');
Route::get('user/make-profile', 'UserController@create_profile');
Route::post('user/get-for-select2', 'UserController@get_for_select2');

Route::get('user/change-profile-pic/{id}', 'UserController@change_pro_pic');
Route::post('user/change-profile-pic', 'UserController@update_pro_pic');
Route::get('user/select-profile-pic/{pic_id}', 'UserController@select_pro_pic');
Route::get('user/delete-profile-pic/{pic_id}', 'UserController@delete_pro_pic');

Route::get('role/all', 'RoleController@index');
Route::get('roles', 'RoleController@index');
Route::get('role/add-new', 'RoleController@add_new_role');
Route::get('role/edit/{id?}', 'RoleController@edit_role');
Route::post('role/edit', 'RoleController@update_role');
Route::get('role/change-status/{id?}', 'RoleController@update_status');
Route::get('role/delete/{id?}', 'RoleController@delete');
Route::get('role/definition/{id?}', 'RoleController@view_role_definition');
Route::post('role/update-ability', 'RoleController@update_single_ability');
//Route::post('role/definition', 'RoleController@update_role_definition');

Route::get('role/assign/{id?}', 'RoleController@assign_to_user');
Route::post('role/assign', 'RoleController@save_roll_assign');

Route::get('role/override/{id?}', 'RoleController@view_user_abilities');
Route::post('role/override', 'RoleController@override_user_abilities');

Route::post('role/update-ability', 'RoleController@update_single_ability');

Route::get('file/serve/{hash?}', 'FileController@serve');
Route::get('file/download/{hash?}', 'FileController@download');
