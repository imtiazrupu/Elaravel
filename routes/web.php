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

/* Route::get('/', function () {
    return view('layout');
});
*/

Route::get('/', 'HomeController@index')->name('home');

// Backend Site
Route::group(['as'=>'admin.','prefix' => 'admin', 'namespace' => 'Admin','middleware'=>['auth','admin']], function () {
// Route::get('/login','AdminController@login');
Route::get('/dashboard','AdminController@index')->name('dashboard');

// Category
Route::resource('category','CategoryController');
Route::put('/category/inactive/{id}','CategoryController@inactive')->name('category.inactive');
Route::put('/category/active/{id}','CategoryController@active')->name('category.active');

//SubCategory
Route::resource('subcategory','SubCategoryController');
Route::put('/subcategory/inactive/{id}','SubCategoryController@inactive')->name('subcategory.inactive');
Route::put('/subcategory/active/{id}','SubCategoryController@active')->name('subcategory.active');
});



Auth::routes();

Route::group(['as'=>'user.','prefix' => 'user', 'namespace' => 'User','middleware'=>['auth','user']], function () {
    Route::get('/profile','UserController@index')->name('profile');
});

