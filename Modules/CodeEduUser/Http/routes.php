<?php

Route::group(['as' => 'codeeduuser.','middleware' => ['web',config('codeeduuser.middleware.isVerified')]], function(){
    
    Route::group(['prefix' => 'admin','middleware' => 'can:user-admin'],function(){
        Route::resource('users', '\CodeEduUser\Http\Controllers\UsersController', ['except'=>'show']);
        Route::resource('roles', '\CodeEduUser\Http\Controllers\RolesController', ['except'=>'show']);
     
        Route::get('roles/{role}/permissions', '\CodeEduUser\Http\Controllers\RolesController@editPermission')->name('roles.permissions.edit');
        Route::put('roles/{role}/permissions', '\CodeEduUser\Http\Controllers\RolesController@updatePermission')->name('roles.permissions.update');
    });

    Route::group(['prefix' => 'users'],function(){
        Route::get('settings','\CodeEduUser\Http\Controllers\UserSettingsController@edit')->name('user_settings.edit');
        Route::put('settings','\CodeEduUser\Http\Controllers\UserSettingsController@update')->name('user_settings.update');
    });

    Route::get('email-verification/error', '\CodeEduUser\Http\Controllers\UserConfirmationController@getVerificationError')->name('email-verification.error');
    Route::get('email-verification/check/{token}','\CodeEduUser\Http\Controllers\UserConfirmationController@getVerification')->name('email-verification.check');
});

