<?php


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']],function (){
    Route::get('dashboard','DashboardController@dashboard')->name('dashboard');
    Route::resource('delivery-address','DeliveryAddressController');
    Route::get('orders','OrderController@index')->name('orders.index');
    Route::get('orders/{id}','OrderController@orderDetails')->name('orders.details');

});
