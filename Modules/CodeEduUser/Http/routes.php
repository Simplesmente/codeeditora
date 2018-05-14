<?php

Route::group(['as' => 'codeeduuser.','middleware' => ['web',config('codeeduuser.middleware.isVerified')]], function(){
    Route::group(['prefix' => 'admin','middleware' => 'can:user-admin' ],function(){
        Route::resource('users', '\CodeEduUser\Http\Controllers\UsersController', ['except'=>'show']);
    });

    Route::group(['prefix' => 'users'],function(){
        Route::get('settings','\CodeEduUser\Http\Controllers\UserSettingsController@edit')->name('user_settings.edit');
        Route::put('settings','\CodeEduUser\Http\Controllers\UserSettingsController@update')->name('user_settings.update');
    });

    Route::get('email-verification/error', '\CodeEduUser\Http\Controllers\UserConfirmationController@getVerificationError')->name('email-verification.error');
    Route::get('email-verification/check/{token}','\CodeEduUser\Http\Controllers\UserConfirmationController@getVerification')->name('email-verification.check');
});

// Route::group(['middleware' => 'web', 'prefix' => 'codeeduuser', 'namespace' => '\CodeEduUser\Http\Controllers'], function()
// {
//     Route::get('/', 'CodeEduUserController@index');
// });
