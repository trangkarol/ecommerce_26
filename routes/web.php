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

Route::get('/', function () {
    return view('welcome');
});

//admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function () {
    // product
    Route::resource('product', 'ProductController');
    Route::resource('order', 'OrderController');
    Route::resource('request', 'RequestController');
    Route::resource('user', 'UserController');
    Route::resource('statistic', 'StatisticController');
    Route::resource('category', 'CategoryController');

    Route::group(['prefix' => 'product'], function () {
        Route::post('/sub-category', 'ProductController@getSubCategory');
        Route::post('/import-file', 'ProductController@importFile');
        Route::post('/save-file', 'ProductController@saveFile');
        Route::post('/search', 'ProductController@search');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::post('/import-file', 'UserController@importFile');
        Route::post('/export-file', 'UserController@exportFile');
        Route::post('/save-file', 'UserController@saveFile');
        Route::post('/search', 'UserController@search');
    });

    Route::group(['prefix' => 'statistic'], function () {
        Route::post('/export-file', 'StatisticController@exportFile');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::post('/search', 'OrderController@search');
        Route::get('/change-status/{id}/{status}', 'OrderController@changeStatus');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::post('/search', 'CategoryController@search');
    });

    Route::group(['prefix' => 'request'], function () {
        Route::post('/request', 'RequestController@search');
    });
});

//member , 'middleware' => 'admin'
Route::group(['prefix' => 'member', 'namespace' => 'Member'], function () {
    // home
    Route::resource('home', 'HomeController');
    Route::resource('suggest', 'SuggestProductController');
    Route::resource('order', 'OrderController');
    Route::resource('product', 'ProductController', ['only' => ['index', 'show']]);
    Route::get('/get-login', 'HomeController@getFormLogin');
    Route::post('/sub-category', 'SuggestProductController@getCategory');
    Route::post('/add-cart', 'OrderController@addCart');
    Route::post('/remove-cart', 'OrderController@removeCart');
    Route::get('/category/{categoryId}', 'ProductController@getProductCategory');
    Route::post('/search-product', 'ProductController@searchProduct');
    Route::post('/add-rating', 'RatingController@addRating');
});

/*login user*/
Route::group(['namespace' => 'Auth'], function() {
    Route::get('/login', 'LoginController@index');
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout');
    Route::post('/change-password', 'ResetPasswordController@changePassword');
    // register
    Route::get('/register', 'RegisterController@index');
    Route::post('/register', 'RegisterController@register');
    //update user
    Route::get('/update/{id}', 'RegisterController@getUpdate');
    Route::post('/update/{id}', 'RegisterController@update');
    // change password
    Route::get('/page-change-password', 'ResetPasswordController@index');
    //forgot password
    Route::get('/forgot-password', 'ForgotPasswordController@index');
    Route::post('/forgot-password', 'ForgotPasswordController@forgotPassword');
    // OAuth Routes
    Route::get('/auth/{provider}', 'SocialiteController@redirectToProvider');
    Route::get('/auth/{provider}/callback', 'SocialiteController@handleProviderCallback');
});

Route::get('/home', 'HomeController@index');
