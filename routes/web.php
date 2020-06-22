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
Route::get('/logout','AdminController@logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Category Route
Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
Route::match(['get','post'],'/admin/display-category','CategoryController@displayCategory');
Route::match(['get','post'],'/saveCategory/edits/{id}','CategoryController@editCategory');
Route::get('/saveCategory/delete/{id}','CategoryController@deleteCategory');

//Product Route
Route::match(['get','post'],'/admin/add-product','ProductController@addProduct');
Route::match(['get','post'],'/admin/display-product','ProductController@displayProduct');
Route::match(['get','post'],'/saveProduct/edits/{id}','ProductController@editProduct');
Route::get('/saveProduct/delete/{id}','ProductController@deleteProduct');
Route::post('/admin/update-product-status','ProductController@updateStatus');

//Banner Route
Route::match(['get','post'],'/admin/banners','BannerController@banners');
Route::match(['get','post'],'/admin/add-banner','BannerController@addBanner');




