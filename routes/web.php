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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::match(['get','post'],'/','FrontendController@index');
Route::match(['get','post'],'/admin','AdminController@login');
Route::get('/product/{id}', 'ProductController@products');
Route::get('/category/{category_id}', 'FrontendController@category');
Route::get('/get-product-price','ProductController@getPrice');
//Route for login-register
Route::get('/login-register','UserController@userLoginRegister');
//Route for login-user
Route::post('/user-login','UserController@login');
//Route for add users registration
Route::post('/user-register','UserController@register');
//Route for user logout
Route::get('/user-logout','UserController@logout');

//Route for add to cart
Route::match(['get','post'],'add-cart','ProductController@addtocart');

//Route for cart
Route::match(['get','post'],'/cart','ProductController@cart')->middleware('verified');

//Route for delete cart product
Route::get('/cart/delete-product/{id}','ProductController@deleteCartProduct');

//Route for update Quantity
Route::get('/cart/update-quantity/{id}/{quantity}','ProductController@updateCartQuantity');

//Apply Coupon code
Route::post('/cart/apply-coupon','ProductController@applyCoupon');

Route::get('/logout','AdminController@logout');

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');

//Route for middleware after front login
Route::group(['middleware'=>['frontlogin']],function(){
	//Route for user account
Route::match(['get','post'],'/account','UserController@account');
Route::match(['get','post'],'/change-password','UserController@changePassword');
Route::match(['get','post'],'/change-address','UserController@changeAddress');
Route::match(['get','post'],'/checkout','ProductController@checkout');

});


//Category Route
Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
Route::match(['get','post'],'/admin/display-category','CategoryController@displayCategory');
Route::match(['get','post'],'/saveCategory/edits/{id}','CategoryController@editCategory');
Route::get('/saveCategory/delete/{id}','CategoryController@deleteCategory');
Route::post('/admin/update-category-status','CategoryController@updateStatus');

//Product Route
Route::match(['get','post'],'/admin/add-product','ProductController@addProduct');
Route::match(['get','post'],'/admin/display-product','ProductController@displayProduct');
Route::match(['get','post'],'/saveProduct/edits/{id}','ProductController@editProduct');
Route::get('/saveProduct/delete/{id}','ProductController@deleteProduct');
Route::post('/admin/update-product-status','ProductController@updateStatus');
Route::post('/admin/update-featured-product-status','ProductController@updateFeatured');

//Products Attributes
Route::match(['get','post'],'/admin/add-attributes/{id}','ProductController@addAttributes');
Route::get('/admin/delete-attribute/{id}','ProductController@deleteAttribute');
Route::match(['get','post'],'/admin/edit-attribute/{id}','ProductController@editAttribute');
Route::match(['get','post'],'/admin/add-images/{id}','ProductController@addImages');
Route::get('/admin/delete-alt-image/{id}','ProductController@deleteAltImage');

//Banner Route
Route::match(['get','post'],'/admin/banners','BannerController@banners');
Route::match(['get','post'],'/admin/add-banner','BannerController@addBanner');
Route::match(['get','post'],'/saveBanner/edits/{id}','BannerController@editBanner');
Route::get('/saveBanner/delete/{id}','BannerController@deleteBanner');
Route::post('/admin/update-banner-status','BannerController@updateStatus');

//Coupon Route
Route::match(['get','post'],'/admin/add-coupon','CouponController@addCoupon');
Route::match(['get','post'],'/admin/view-coupons','CouponController@viewCoupons');
Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponController@editCoupon');
Route::get('/admin/delete-coupon/{id}','CouponController@deleteCoupon');
Route::post('/admin/update-coupon-status','CouponController@updateStatus');