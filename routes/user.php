<?php


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']],function (){
    Route::resource('delivery-address','DeliveryAddressController');
});
