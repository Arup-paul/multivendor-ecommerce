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
    Route::get('/admins/create','AdminManagementController@create')->name('admins.create');
    Route::post('/admins/store','AdminManagementController@store')->name('admins.store');
    Route::get('/admins/edit/{id}','AdminManagementController@edit')->name('admins.edit');
    Route::put('/admins/update/{id}','AdminManagementController@update')->name('admins.update');
    Route::post('/admins/mass-destroy','AdminManagementController@massDestroy')->name('admins.mass-destroy');


    Route::get('/send-email/{id}','AdminManagementController@sendEmail')->name('admins.send-email');


    //role permission
    Route::get('role-permission/{id}','RoleController@rolePermission')->name('role-permission');
    Route::post('role-permission/{id}','RoleController@rolePermissionUpdate')->name('role-permission');


    //vendor management
    Route::get('vendor-details/{id}','AdminManagementController@vendorDetails')->name('vendor-details');
    Route::resource('vendors','VendorController');

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
    Route::post('category-filter','ProductController@categoryFilter')->name('products.category_filter');
    Route::resource('products','ProductController');

    //product attribute
    Route::get('product-attributes/{id}','ProductAttributeController@create')->name('product-attributes.create');
    Route::post('product-attributes','ProductAttributeController@store')->name('product-attributes.store');
    Route::post('product-attributes/update','ProductAttributeController@update')->name('product-attributes.update');

    //product image
    Route::get('product-images/{id}','ProductImageController@create')->name('product-images.create');
    Route::post('product-images','ProductImageController@store')->name('product-images.store');
    Route::post('product-images/update','ProductImageController@update')->name('product-images.update');

    //filter
    Route::post('filters/mass-destroy','FilterController@massDestroy')->name('filters.mass-destroy');
    Route::resource('filters','FilterController');

    //filter value
    Route::post('filter-values/mass-destroy','FilterValueController@massDestroy')->name('filter-values.mass-destroy');
    Route::resource('filter-values','FilterValueController');

    //Coupon
    Route::post('coupons/mass-destroy','CouponController@massDestroy')->name('coupons.mass-destroy');
    Route::resource('coupons','CouponController');

    //customer
    Route::post('customers/mass-destroy','CustomerController@massDestroy')->name('customers.mass-destroy');
    Route::resource('customers','CustomerController');

    //order
    Route::post('/orders/mass-destroy','OrderController@massDestroy')->name('orders.mass-destroy');
    Route::get('orders/invoice/{order}', 'OrderController@invoice')->name('orders.invoice');
    Route::get('orders/pdf', 'OrderController@orderPdf')->name('orders.pdf');
    Route::post('orders/payment-status/{id}', 'OrderController@paymentStatusUpdate')->name('orders.payment-status');
    Route::post('orders/order-status/{id}', 'OrderController@orderStatusUpdate')->name('orders.order-status');
    Route::resource('orders', 'OrderController');

    //return order
    Route::get('orders-return','ReturnOrderController@index')->name('orders.return');
    Route::post('orders-return/update/{id}','ReturnOrderController@updateStatus')->name('orders.return.update');

    //exchange order
    Route::get('orders-exchange','ExchangeOrderController@index')->name('orders.exchange');
    Route::post('orders-exchange/update/{id}','ExchangeOrderController@updateStatus')->name('orders.exchange.update');

    //shipping charge
    Route::post('shipping-charge/mass-destroy','ShippingController@massDestroy')->name('shipping-charge.mass-destroy');
    Route::resource('shipping-charge','ShippingController');

    Route::post('/pages/mass-destroy','PageController@massDestroy')->name('pages.mass-destroy');
    Route::resource('pages','PageController');

    //fronted settings
    Route::post('sliders/mass-destroy','SliderController@massDestroy')->name('sliders.mass-destroy');
    Route::resource('sliders','SliderController');

    //review
     Route::get('ratings','RatingController@index')->name('ratings.index');
     Route::get('ratings/edit/{id}','RatingController@edit')->name('ratings.edit');
     Route::put('ratings/update/{id}','RatingController@update')->name('ratings.update');
     Route::post('ratings/mass-destroy','RatingController@massDestroy')->name('ratings.mass-destroy');


     //blog
        Route::post('blogs/mass-destroy','BlogController@massDestroy')->name('blogs.mass-destroy');
        Route::resource('blogs','BlogController');




    //media controller
    Route::resource('media', 'MediaController');
    Route::get('medias/list', 'MediaController@list')->name('media.list');
    Route::post('medias/delete', 'MediaController@destroy')->name('medias.delete');
});



