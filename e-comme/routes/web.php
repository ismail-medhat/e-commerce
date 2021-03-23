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
    // Category Section..
    Route::group(['namespace'=>'Category'], function (){
       Route::get('categories','CategoryController@category')->name('categories');
       Route::post('store/category','CategoryController@storeCategory')->name('store.category');
       Route::get('delete/category/{cat_id}','CategoryController@deleteCategory')->name('delete.category');
       Route::get('edit/category/{cat_id}','CategoryController@editCategory')->name('edit.category');
       Route::post('update/category/{cat_id}','CategoryController@updateCategory')->name('update.category');
    });
    // Brands Section..
    Route::group(['namespace'=>'Category'], function (){
        Route::get('brands','BrandController@brand')->name('brands');
        Route::post('store/brand','BrandController@storeBrand')->name('store.brand');
        Route::get('delete/brand/{brand_id}','BrandController@deleteBrand')->name('delete.brand');
        Route::get('edit/brand/{brand_id}','BrandController@editBrand')->name('edit.brand');
        Route::post('update/brand/{brand_id}','BrandController@updateBrand')->name('update.brand');
    });
    // Subcategories Section..
    Route::group(['namespace'=>'Category'], function (){
        Route::get('subcategories','SubCategoryController@subcategory')->name('sub.categories');
        Route::post('store/subcategories','SubCategoryController@storeSubcategory')->name('store.subcategory');
        Route::get('delete/subcategory/{subcat_id}','SubCategoryController@deleteSubcategory')->name('delete.subcategory');
        Route::get('edit/subcategory/{subcat_id}','SubCategoryController@editSubcategory')->name('edit.subcategory');
        Route::post('update/subcategory/{subcat_id}','SubCategoryController@updateSubcategory')->name('update.subcategory');
    });
});
