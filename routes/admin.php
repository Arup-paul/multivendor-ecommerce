<?php

use Illuminate\Support\Facades\Route;


Route::match(['get','post'],'login', 'AdminController@login')->name('login');

Route::group(['middleware' => ['admin']],function (){
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('logout', 'AdminController@logout')->name('logout');

        Route::match(['get','post'],'update-password', 'AdminController@updatePassword')->name('update-password');

        //check Admin Password
        Route::post('check-current-password', 'AdminController@checkCurrentPassword')->name('check-current-password');


    Route::get('update-profile', 'AdminController@updateProfile')->name('update-profile');
});



