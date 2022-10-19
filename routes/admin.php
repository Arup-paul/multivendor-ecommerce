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
    Route::post('admins/update-status/{id}','AdminManagementController@updateStatus')->name('admins.update-status');
    Route::get('/send-email/{id}','AdminManagementController@sendEmail')->name('admins.send-email');
    Route::get('vendor-details/{id}','AdminManagementController@vendorDetails')->name('vendor-details');

    //section management
    Route::post('sections/mass-destroy','SectionController@massDestroy')->name('sections.mass-destroy');
    Route::resource('sections','SectionController');

    //category
    Route::get('append-categories-level','CategoryController@appendCategoriesLevel')->name('append-categories-level');
    Route::post('categories/mass-destroy','CategoryController@massDestroy')->name('categories.mass-destroy');
    Route::resource('categories','CategoryController');

    //brand
    Route::post('brands/mass-destroy','BrandController@massDestroy')->name('brands.mass-destroy');
    Route::resource('brands','BrandController');

    //product
    Route::post('products/mass-destroy','ProductController@massDestroy')->name('products.mass-destroy');
    Route::resource('products','ProductController');

    //product attribute
    Route::get('product-attributes/{id}','ProductAttributeController@create')->name('product-attributes.create');
    Route::post('product-attributes','ProductAttributeController@store')->name('product-attributes.store');
    Route::post('product-attributes/update','ProductAttributeController@update')->name('product-attributes.update');

    //media controller
    Route::resource('media', 'MediaController');
    Route::get('medias/list', 'MediaController@list')->name('media.list');
    Route::post('medias/delete', 'MediaController@destroy')->name('medias.delete');
});



