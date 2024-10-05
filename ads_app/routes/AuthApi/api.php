<?php

Route::post('/auth/login', 'Auth\AuthController@login')->name('post.login');
Route::post('/auth/logout', 'Auth\AuthController@logout')->name('post.logout');
Route::post('/auth/refresh', 'Auth\AuthController@refresh')->middleware('auth')->name('refresh');
