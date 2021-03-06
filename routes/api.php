<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

    Route::resource('unit', 'UnitController');
    Route::resource('unit/{unit}/schedule', 'UnitScheduleController', ['as' => 'unit']);
    Route::resource('unit/{unit}/queue', 'UnitQueueController', ['as' => 'unit']);

    Route::resource('doctor', 'DoctorController');
    Route::resource('doctor/{doctor}/schedule', 'DoctorScheduleController', ['as' => 'doctor']);
    Route::resource('doctor/{doctor}/queue', 'DoctorQueueController', ['as' => 'doctor']);

    Route::resource('patient', 'PatientController', ['as' => 'patient']);
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('oauth/{provider}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{provider}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});
