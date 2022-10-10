<?php

use Illuminate\Support\Facades\Route;


Route::match(['get','post'],'login', 'AdminController@login')->name('login');

Route::group(['middleware' => ['admin']],function (){
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
});



