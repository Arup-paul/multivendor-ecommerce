<?php


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']],function (){
    Route::resource('delivery-address','DeliveryAddressController');
    Route::get('orders','OrderController@index')->name('orders.index');

});
