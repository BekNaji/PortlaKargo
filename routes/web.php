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
Route::redirect('/home', '/dashboard/index');
Route::redirect('/admin', '/dashboard/index');
Route::redirect('dashboard', '/dashboard/index');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/search', 'HomeController@search')->name('search');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware('auth')->prefix('dashboard')->namespace('admin')->group(function(){

	Route::get('index', 'DashboardController@index')->name('dashboard.index');

	

	// profile
	Route::get('profile/index', 'ProfileController@index')->name('profile.index');
	Route::post('profile/update', 'ProfileController@update')->name('profile.update');

	// User Route
	Route::get('user/index', 'UserController@index')->name('user.index');
	Route::post('user/edit', 'UserController@edit')->name('user.edit');
	Route::post('user/update', 'UserController@update')->name('user.update');
	Route::post('user/store', 'UserController@store')->name('user.store');
	Route::post('user/delete', 'UserController@delete')->name('user.delete');

	// Customer Route
	Route::get('customer/index', 'CustomerController@index')->name('customer.index');
	Route::get('cargo/customer/create/{id}', 'CustomerController@create')->name('customer.create');
	Route::get('customer/edit/{id}/{type?}', 'CustomerController@edit')->name('customer.edit');
	Route::post('customer/update', 'CustomerController@update')->name('customer.update');
	Route::post('customer/store', 'CustomerController@store')->name('customer.store');
	Route::post('customer/delete', 'CustomerController@delete')->name('customer.delete');
	Route::get('customer/get', 'CustomerController@get')->name('customer.get');

	// Receiver Route
	Route::get('receiver/index', 'ReceiverController@index')->name('receiver.index');

	Route::get('cargo/receiver/create/{id}', 'ReceiverController@create')->name('receiver.create');


	Route::get('receiver/edit/{id}/{type?}', 'ReceiverController@edit')->name('receiver.edit');
	Route::post('receiver/update', 'ReceiverController@update')->name('receiver.update');
	Route::post('receiver/store', 'ReceiverController@store')->name('receiver.store');
	Route::post('receiver/delete', 'ReceiverController@delete')->name('receiver.delete');
	Route::get('receiver/get', 'ReceiverController@get')->name('receiver.get');

	// Product Route
	
	Route::post('product/edit', 'ProductController@edit')->name('product.edit');
	Route::post('product/update', 'ProductController@update')->name('product.update');
	Route::post('product/store', 'ProductController@store')->name('product.store');
	Route::post('product/delete', 'ProductController@delete')->name('product.delete');



	// Cargo route
	Route::get('cargo/index', 'CargoController@index')->name('cargo.index');
	Route::get('cargo/create', 'CargoController@create')->name('cargo.create');
	Route::get('cargo/show/{id}', 'CargoController@show')->name('cargo.show');
	Route::get('cargo/edit/{id}', 'CargoController@edit')->name('cargo.edit');
	Route::post('cargo/update', 'CargoController@update')->name('cargo.update');
	Route::post('cargo/store', 'CargoController@store')->name('cargo.store');
	Route::post('cargo/delete', 'CargoController@delete')->name('cargo.delete');
	Route::get('cargo/pdf/{id}', 'CargoController@pdf')->name('cargo.pdf');
	Route::get('cargo/filter', 'CargoController@filter')->name('cargo.filter');
	Route::post('cargo/changeStatus', 'CargoController@changeStatus')->name('cargo.change.status');

	// Cargo Status route
	Route::get('status/cargo/index', 'CargoStatusController@index')->name('status.cargo.index');
	Route::get('status/cargo/create', 'CargoStatusController@create')->name('status.cargo.create');
	Route::post('status/cargo/edit', 'CargoStatusController@edit')->name('status.cargo.edit');
	Route::post('status/cargo/update', 'CargoStatusController@update')->name('status.cargo.update');
	Route::post('status/cargo/store', 'CargoStatusController@store')->name('status.cargo.store');
	Route::post('status/cargo/delete', 'CargoStatusController@delete')->name('status.cargo.delete');

	Route::get('status/log/index', 'CargoLogController@index')->name('cargo.log.index');
	Route::get('status/log/store', 'CargoLogController@store')->name('cargo.log.store');

	// company route
	Route::get('settings/index', 'SettingsController@index')->name('settings.index');
	Route::post('settings/update', 'SettingsController@update')->name('settings.update');



	
});

