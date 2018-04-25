<?php

Route::resource('categories', '\CodeEduBook\Http\Controllers\CategoryController', ['except'=>'show']);
Route::resource('books', '\CodeEduBook\Http\Controllers\BookController', ['except'=>'show']);

Route::group(['prefix' => 'trashed', 'as' => 'trashed.'],function(){
    Route::resource('books', 'CodeEduBook\Http\Controllers\BookTrashedController', ['except'=>['destroy','create','edit']]);
});

//Route::get('/test', 'CodeEduBook\Http\Controllers\CodeEduBookController@index');