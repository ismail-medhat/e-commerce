<?php

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


Route::get('/', function () {return view('pages.index');})->name('page.index');

//auth & user
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password-update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@logout')->name('user.logout');


// Admin Route....

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/', 'LoginController@login');
    Route::get('home', 'AdminController@index')->name('admin.home');
    Route::get('/logout', 'AdminController@logout')->name('admin.logout');
    // Password Reset Routes...
    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/reset/password/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/update/reset', 'ResetPasswordController@reset')->name('admin.reset.update');
    Route::get('/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
    Route::post('/password/update','AdminController@Update_pass')->name('admin.password.update');

    Route::group(['namespace'=>'Category'], function (){

        // Category Section..
       Route::get('categories','CategoryController@category')->name('categories');
       Route::post('store/category','CategoryController@storeCategory')->name('store.category');
       Route::get('delete/category/{cat_id}','CategoryController@deleteCategory')->name('delete.category');
       Route::get('edit/category/{cat_id}','CategoryController@editCategory')->name('edit.category');
       Route::post('update/category/{cat_id}','CategoryController@updateCategory')->name('update.category');

        // Brands Section..
        Route::get('brands','BrandController@brand')->name('brands');
        Route::post('store/brand','BrandController@storeBrand')->name('store.brand');
        Route::get('delete/brand/{brand_id}','BrandController@deleteBrand')->name('delete.brand');
        Route::get('edit/brand/{brand_id}','BrandController@editBrand')->name('edit.brand');
        Route::post('update/brand/{brand_id}','BrandController@updateBrand')->name('update.brand');

        // Coupons Section..
        Route::get('subcategories','SubCategoryController@subcategory')->name('sub.categories');
        Route::post('store/subcategories','SubCategoryController@storeSubcategory')->name('store.subcategory');
        Route::get('delete/subcategory/{subcat_id}','SubCategoryController@deleteSubcategory')->name('delete.subcategory');
        Route::get('edit/subcategory/{subcat_id}','SubCategoryController@editSubcategory')->name('edit.subcategory');
        Route::post('update/subcategory/{subcat_id}','SubCategoryController@updateSubcategory')->name('update.subcategory');

        // Coupons Section..
        Route::get('sub/coupon','CouponController@Coupon')->name('admin.coupon');
        Route::post('store/coupon','CouponController@storeCoupon')->name('store.coupon');
        Route::get('delete/coupon/{coupon_id}','CouponController@deleteCoupon')->name('delete.coupon');
        Route::get('edit/coupon/{coupon_id}','CouponController@editCoupon')->name('edit.coupon');
        Route::post('update/coupon/{coupon_id}','CouponController@updateCoupon')->name('update.coupon');

        // Newslaters Section..
        Route::get('newslater','CouponController@Newslater')->name('admin.newslater');
        Route::get('delete/newslater/{news_id}','CouponController@deleteNewslater')->name('delete.subscribe');

    });

    // Product All Route..
    Route::group(['namespace'=>'Product'],function (){

        // Product
        Route::get('product/all','ProductController@index')->name('all.product');
        Route::get('product/add','ProductController@create')->name('add.product');
        // For Show Sub category with ajax..
        Route::get('get/subcategory/{category_id}','ProductController@GetSubcat');
        // Store Product info..
        Route::post('store/product','ProductController@store')->name('store.product');
        Route::get('view/product/{product_id}','ProductController@show')->name('show.product');
        Route::get('active/product/{product_id}','ProductController@active')->name('active.product');
        Route::get('inactive/product/{product_id}','ProductController@inactive')->name('inactive.product');
        Route::get('delete/product/{product_id}','ProductController@deleteproduct')->name('delete.product');
        Route::get('edit/product/{product_id}','ProductController@editproduct')->name('edit.product');
        Route::post('update/product/{product_id}','ProductController@updateproduct')->name('update.product');
        Route::post('update/product/image/{product_id}','ProductController@UpdateProductImges')->name('update.product.images');

    });

});

// Front-End All Route..
Route::group(['namespace'=>'Front'],function (){

    // Subscribe
    Route::post('store/newslater','FrontController@StoreNewslater')->name('store.newslater');
});
