<?php

use App\Http\Route;

Route::get('/', 'MainController@index');
Route::post('/users/create', 'UsersController@store');
Route::post('/users/login', 'UsersController@login');
Route::get('/users', 'UsersController@show');
Route::put('/users', 'UsersController@update');
Route::delete('/users/{id}/delete', 'UsersController@destroy');
