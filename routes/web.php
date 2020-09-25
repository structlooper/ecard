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
//
//Route::get('/', function () {
//    return view('welcome');
//});
/**
 * Route group with namespace
 * @structlooper
 * */

Auth::routes();
Auth::routes(['register' => false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['namespace' => 'App\Http\Controllers'] ,function(){
    Route::get('/test',function(){
       echo phpinfo();
    });
/**
 * Guest routes
 * @strcutlooper
 */
    Route::group(['middleware' => 'checkAdmin'],function(){
        Route::get('/','AdminController@login_view')->name('login_page');

    });
/**
 * Admin routes
 * @strcutlooper
 * */
    Route::group(['prefix' => 'admin' , 'middleware' => 'checkUser'],function(){
        Route::get('dashboard','AdminController@home')->name('dashboard');
        Route::get('update/password','AdminController@update_password_page')->name('update_password_page');
        Route::post('update/password','AdminController@update_password')->name('update_password');
        Route::get('user/list','AdminController@user_list')->name('user_list');
        Route::post('user/list/password','AdminController@update_user_password')->name('update_user_password');

//        Card categories
        Route::get('card/categories','AdminController@card_categories')->name('card_categories');
        Route::post('card/categories/add','AdminController@card_add')->name('add_card');
        Route::post('card/categories/update','AdminController@update_card')->name('update_card');
        Route::post('card/categories/delete','AdminController@delete_card')->name('delete_card');
        // Ajax request
        Route::post('card/fetch','AdminController@card_fetch')->name('card_fetch');
//        Card Management
        Route::get('card/management','AdminController@card_list')->name('card_list');
        Route::post('card/management/add','AdminController@add_card_management')->name('add_card_management');
        Route::post('card/management/update','AdminController@update_card_management')->name('update_card_management');
        Route::post('card/management/delete','AdminController@delete_card_management')->name('delete_card_management');

        // Ajax request
        Route::post('card/management/fetch','AdminController@card_management_fetch')->name('card_management_fetch');

//        Order Management
        Route::get('order/odrManagement','AdminController@order_management')->name('order_management');
    });


});

