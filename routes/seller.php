<?php

use Illuminate\Support\Facades\Route;

Route::get('/login','AuthController@login')->name('login');
Route::post('/login','AuthController@processLogin')->name('login');
Route::get('/register','AuthController@register')->name('register');
Route::post('/register','AuthController@processRegister')->name('register');
Route::get('/logout','AuthController@logout')->name('logout');
