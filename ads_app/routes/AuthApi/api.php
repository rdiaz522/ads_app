<?php

Route::post('/auth/login', 'Auth\AuthController@login')->name('postLogin');
Route::post('/auth/logout', 'Auth\AuthController@logout')->name('postLogout');
Route::post('/auth/refresh', 'Auth\AuthController@refresh')->middleware('auth')->name('refresh');
