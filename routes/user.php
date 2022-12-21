<?php


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']],function (){
    Route::get('dashboard','DashboardController@dashboard')->name('dashboard');


    Route::resource('delivery-address','DeliveryAddressController');
    Route::get('orders','OrderController@index')->name('orders.index');
    Route::get('orders/{id}','OrderController@orderDetails')->name('orders.details');
    Route::get('orders/cancel/{id}','OrderController@orderCancel')->name('orders.cancel');
    Route::post('orders/cancel/{id}','OrderController@orderCancelProcess')->name('orders.cancel');
    Route::get('orders/return/{id}','OrderController@orderReturn')->name('orders.return');
    Route::post('orders/return/{id}','OrderController@orderReturnProcess')->name('orders.return');

    Route::post('review/store','RatingController@store')->name('review.store');
    Route::get('review','RatingController@index')->name('review.index');

    //wishlist
    Route::post('wishlist','WishlistController@addWishlist')->name('wishlist');
    Route::get('wishlist','WishlistController@index')->name('wishlist.index');
    Route::post('wishlist/delete','WishlistController@destroy')->name('wishlist.destroy');
    Route::post('wishlist/mass-destroy','WishlistController@massDestroy')->name('wishlist.mass-destroy');

});
