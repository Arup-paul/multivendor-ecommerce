<?php


use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::namespace('App\Http\Controllers\Frontend')->group(function(){
    Route::get('/','HomeController@index')->name('home');

    //user auth
    Route::get('/login','AuthController@login')->name('login');
    Route::post('/login','AuthController@processLogin')->name('login');
    Route::get('/register','AuthController@register')->name('register');
    Route::post('/register','AuthController@processRegister')->name('register');
    Route::get('/logout','AuthController@logout')->name('logout')->middleware('auth');



    //listing
    if(Schema::hasTable('categories')){
        $category =  Category::select(['url'])->whereStatus(1)->pluck('url');
        foreach($category as $url){
            Route::match(['get','post'],'/'.$url,'ProductController@listing')->name('listing');
        }
    }

    Route::match(['get','post'],'shop','ProductController@shop')->name('shop');


    Route::get('/product/{slug}','ProductController@productDetails')->name('product.details');
    Route::post('get-product-price','ProductController@getProductPrice')->name('get.product.price');

    //vendor products listing
    Route::get('/products/{vendorId}','ProductController@vendorListing')->name('product.vendor-listing');


    //cart
    Route::post('/cart/add','CartController@cartAdd')->name('cart.add');
    Route::get('/cart','CartController@cart')->name('cart');
    Route::post('/cart/update-qty','CartController@cartUpdate')->name('cart.update-qty');
    Route::post('/cart/remove-item','CartController@removeItem')->name('cart.remove-item');

    //coupon
    Route::post('/apply-coupon','CartController@applyCoupon')->name('apply.coupon');

    //checkout

    Route::get('/checkout','CheckoutController@checkout')->name('checkout');
    Route::post('/checkout','CheckoutController@processCheckout')->name('checkout');




    //page
    Route::get('/page/{slug}','PageController@page')->name('page');


    Route::get('/contact','ContactController@contact')->name('contact');

    //order track
    Route::get('/order/track','OrderTrackController@index')->name('order.track');




});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';



