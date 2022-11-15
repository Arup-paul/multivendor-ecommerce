<?php


use Illuminate\Support\Facades\Route;

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

    //listing
    if(\Illuminate\Support\Facades\Schema::hasTable('categories')){
        $category = \App\Models\Category::select(['url'])->whereStatus(1)->pluck('url');
        foreach($category as $url){
            Route::match(['get','post'],'/'.$url,'ProductController@listing')->name('listing');
        }
    }

    Route::get('/product/{slug}','ProductController@productDetails')->name('product.details');
    Route::post('get-product-price','ProductController@getProductPrice')->name('get.product.price');



});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';



