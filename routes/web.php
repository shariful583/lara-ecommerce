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



Route::group(['namespace' => 'Frontend'],function (){
    Route::get('/', 'HomeController@showHomePage')->name('frontend.home');
    Route::get('/product/{slug}', 'ProductController@showDetails')->name('frontend.details');
    Route::get('/cart', 'CartController@showCart')->name('cart.show');
    Route::post('/cart', 'CartController@addToCart')->name('cart.add');
    Route::post('/cart/remove', 'CartController@removeFromCart')->name('cart.remove');
    Route::get('/cart/clear', 'CartController@clearFromCart')->name('cart.clear');
    Route::get('/checkout', 'CartController@checkout')->name('cart.checkout');



    Route::get('/login', 'AuthController@showLogin')->name('user.login');
    Route::post('/login', 'AuthController@processLogin');


    Route::get('/signup', 'AuthController@showSignup')->name('user.signup');
    Route::post('/signup', 'AuthController@processSignup');


    Route::get('/activate/{token}', 'AuthController@activate')->name('activate');

    Route::group(['middleware' => 'auth'], function (){
        Route::post('/order', 'CartController@processOrder')->name('order');
        Route::get('/order/{id}', 'CartController@orderDetails')->name('order.details');


        Route::get('/profile', 'AuthController@profile')->name('user.profile');
        Route::get('/logout', 'AuthController@logout')->name('user.logout');
    });
});


