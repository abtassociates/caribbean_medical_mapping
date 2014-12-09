<?php


// ------------------ CONSTRAINTS ------------------ //

Route::pattern('token', '[0-9a-z]+');
Route::pattern('id', '[0-9]+');


// ------------------ PUBLIC ----------------------- //

Route::get('/', 'FacilitiesController@index');
Route::post('/set_current_position', 'PublicController@setCurrentPosition');
Route::controller('reports', 'ReportController');
Route::resource('facilities', 'FacilitiesController');
Route::post('facilities/{id}/errors', 'FacilitiesController@error');
Route::post('facilities/missing', 'FacilitiesController@missing');
Route::get('facilities/errors/{id}', 'FacilitiesController@corrections');


// ------------------ USER ---------------------- //

Route::get('login', 'AccountController@getLogin');
Route::post('login', 'AccountController@postLogin');
Route::get('logout', 'AccountController@logout');
Route::get('reset/{token}', 'AccountController@getReset');
Route::post('reset/{token}', 'AccountController@postReset');
Route::get('confirm/{confirmation_code}', 'AccountController@getConfirm');
Route::post('confirm/{confirmation_code}', 'AccountController@postConfirm');
Route::controller('account', 'AccountController');


// ------------------ ADMIN ---------------------- //

Route::controller('settings', 'SettingsController');
Route::resource('users', 'UsersController');

// ------------------ API --------------------------- //

Route::group(array('prefix' => 'api'), function(){
    Route::group(array('prefix' => 'v1'), function(){
		Route::controller('reports', 'APIV1ReportController');
        Route::get('/', 'APIV1Controller@index');
        Route::get('facilities', 'APIV1Controller@facilities');
        Route::get('facilities/{id}', 'APIV1Controller@facility');
        Route::get('filter-options', 'APIV1Controller@filterOptions');
        Route::get('filter-options/sectors', 'APIV1Controller@sectors');
        Route::get('filter-options/services', 'APIV1Controller@services');
        Route::get('filter-options/equipment', 'APIV1Controller@equipment');
        Route::get('filter-options/positions', 'APIV1Controller@positions');
        Route::get('filter-options/proprietors', 'APIV1Controller@proprietors');
    });
});