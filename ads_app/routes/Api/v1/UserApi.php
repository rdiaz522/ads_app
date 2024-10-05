<?php

Route::get('/users', 'Module\User\UserController@show')->name('get.user');
Route::post('/users', 'Module\User\UserController@store')->name('create.user');
Route::get('/users/datatable', 'Module\User\UserController@getUserDataTable')->name('get.user.datatable');
Route::get('/users/{id}', 'Module\User\UserController@getUserById')->name('get.user.id');
