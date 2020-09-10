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
// Route::get('test', 'Admin\CargoController@test')->name('test');
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/api/cargo/status', 'Api\CargoControllerApi@index');


Route::redirect('/', '/home');
Route::redirect('/admin', '/dashboard/index');
Route::redirect('dashboard', '/dashboard/index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/bot/info','HomeController@botInfo')->name('bot.info');

Route::get('save/phone/form/{auth}/{user_id}', 'HomeController@savePhoneForm')->name('save.phone.form');

Route::get('save/phone', 'HomeController@savePhone')->name('save.phone');

Route::get('/price', 'HomeController@price')->name('price');

Route::post('/save/email', 'HomeController@saveEmail')->name('save.email');

Route::get('/telegram', 'TelegrambotController@index')->name('telegram');

Route::get('/testtest', 'TelegrambotController@sendMessage');



Route::middleware('auth')
	   ->prefix('dashboard')->namespace('Admin')->group(function(){
	Route::get('company/index', 'CompanyController@index')->name('company.index');
	Route::get('company/edit/{id}', 'CompanyController@edit')->name('company.edit');
	Route::post('company/delete', 'CompanyController@delete')->name('company.delete');
	Route::post('company/update', 'CompanyController@update')->name('company.update');
	Route::get('company/status', 'CompanyController@status')->name('company.status');
	Route::get('company/register', 'CompanyController@register')->name('company.register');
	Route::post('company/apply', 'CompanyController@apply')->name('company.apply');
	Route::post('company/store', 'CompanyController@store')->name('company.store');


});

Auth::routes();
Route::middleware(['auth','checkcompany'])
	   ->prefix('dashboard')->namespace('Admin')->group(function(){

Route::get('index', 'DashboardController@index')->name('dashboard.index');


// send message
Route::get('telegram/send/message/{id}', 'TelegramController@sendMessage')->name('telegram.send.message');

// send one more message
Route::post('telegram/send/multiple/message/', 'TelegramController@sendMultipleMessage')->name('telegram.send.multiple.message');


// profile
Route::get('profile/index', 'ProfileController@index')->name('profile.index');
Route::post('profile/update', 'ProfileController@update')->name('profile.update');
Route::get('profile/remove/image/{id}', 'ProfileController@removeImage')->name('profile.remove.image');
// User Route
Route::get('user/index', 'UserController@index')->name('user.index');
Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit');
Route::post('user/update', 'UserController@update')->name('user.update');
Route::post('user/store', 'UserController@store')->name('user.store');
Route::post('user/delete', 'UserController@delete')->name('user.delete');
Route::get('user/remove/image/{id}', 'UserController@romoveImage')->name('user.remove.image');
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
Route::post('cargo/store/all', 
	'CargoController@storeAll')->name('cargo.store.all');

Route::post('cargo/update/all', 
	'CargoController@updateAll')->name('cargo.update.all');

Route::get('cargo/print/{id}', 'CargoController@print')->name('cargo.print');

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
Route::get('cargo/manafes', 'CargoController@manafesExcel')->name('cargo.manafes');
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

//sms
Route::get('getbalance', 'SmsController@getBalance')->name('get.balance');

Route::get('sendsms', 'SmsController@sendSMS')->name('send.sms');


});