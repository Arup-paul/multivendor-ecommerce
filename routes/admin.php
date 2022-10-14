<?php

use Illuminate\Support\Facades\Route;


Route::match(['get','post'],'login', 'AdminController@login')->name('login');

Route::group(['middleware' => ['admin']],function (){
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('logout', 'AdminController@logout')->name('logout');

        Route::match(['get','post'],'update-password', 'AdminController@updatePassword')->name('update-password');

        //check Admin Password
        Route::post('check-current-password', 'AdminController@checkCurrentPassword')->name('check-current-password');

        //update admin details
       Route::match(['get','post'],'update-profile-details','AdminController@updateAdminDetails')->name('update-profile-details');

       //update vendor details
        Route::match(['get','post'],'update-vendor-details/{slug}','VendorController@updateVendorDetails')->name('update-vendor-details');

       Route::get('update-profile', 'AdminController@updateProfile')->name('update-profile');

       //admin management
    Route::get('admins','AdminManagementController@admins')->name('admins');
    Route::get('/send-email/{id}','AdminManagementController@sendEmail')->name('admins.send-email');
    Route::get('vendor-details/{id}','AdminManagementController@vendorDetails')->name('vendor-details');

    //media controller
    Route::resource('media', 'MediaController');
    Route::get('medias/list', 'MediaController@list')->name('media.list');
    Route::post('medias/delete', 'MediaController@destroy')->name('medias.delete');
});



