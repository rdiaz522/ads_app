<?php

Route::post('/auth/login', 'Auth\AuthController@login')->name('postLogin');
Route::post('/auth/logout', 'Auth\AuthController@logout')->name('postLogout');
