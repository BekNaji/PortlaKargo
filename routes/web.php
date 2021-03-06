<?php
use Illuminate\Support\Facades\Route;

Route::redirect('/home', '/');
Route::redirect('/admin', '/dashboard/index');
Route::redirect('dashboard', '/dashboard/index');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/bot/info','HomeController@botInfo')->name('bot.info');

Route::get('save/phone/form/{auth}/{user_id}', 'HomeController@savePhoneForm')->name('save.phone.form');

Route::get('save/phone', 'HomeController@savePhone')->name('save.phone');

Route::get('/price', 'HomeController@price')->name('price');

Route::post('/save/email', 'HomeController@saveEmail')->name('save.email');

Route::any('/telegram', 'TelegrambotController@index')->name('telegram.index');





Route::middleware(['auth'])
	   ->prefix('dashboard')
	   ->namespace('Admin')
	   ->group(function(){
	Route::get('company/index', 'CompanyController@index')->name('company.index');
	Route::get('company/edit/{id}', 'CompanyController@edit')->name('company.edit');
	Route::post('company/delete', 'CompanyController@delete')->name('company.delete');
	Route::post('company/update', 'CompanyController@update')->name('company.update');
	Route::get('company/status', 'CompanyController@status')->name('company.status');
	Route::get('company/register', 'CompanyController@register')->name('company.register');
	Route::post('company/apply', 'CompanyController@apply')->name('company.apply');
	Route::post('company/store', 'CompanyController@store')->name('company.store');


});

Auth::routes(['register' => false]);
Route::middleware(['auth','checkcompany','checkact'])
	   ->prefix('dashboard')
	   ->namespace('Admin')
	   ->group(function(){


Route::get('delivery/index','DeliveryController@index')->name('delivery.index');
Route::get('delivery/edit','DeliveryController@edit')->name('delivery.edit');
Route::post('delivery/store','DeliveryController@store')->name('delivery.store');

Route::get('index', 'DashboardController@index')->name('dashboard.index');


// send message
Route::get('telegram/send/message/{id}', 'TelegramController@sendMessage')
->name('telegram.send.message');

// send one more message
Route::post('telegram/send/multiple/message/', 'TelegramController@sendMultipleMessage')
->name('telegram.send.multiple.message');

Route::get('settings/sms/index','SmsController@index')->name('sms.index');
Route::post('settings/sms/update','SmsController@update')->name('sms.update');
Route::post('settings/sms/message/save','SmsController@saveMessage')->name('sms.message.save');



Route::get('settings/web/header','WebController@header')->name('web.header');
Route::post('settings/web/header/store','WebController@headerStore')->name('web.header.store');

Route::get('settings/web/about','WebController@about')->name('web.about');
Route::post('settings/web/about/store','WebController@aboutStore')->name('web.about.store');

// profile
Route::get('profile/index', 'ProfileController@index')
->name('profile.index');

Route::post('profile/update', 'ProfileController@update')
->name('profile.update');

Route::get('profile/remove/image/{id}', 'ProfileController@removeImage')
->name('profile.remove.image');


// User Route
Route::get('user/index', 'UserController@index')->name('user.index');
Route::get('user/permission/{id}', 'UserController@permission')->name('user.permission');

Route::post('user/permission/update', 'UserController@permissionUpdate')->name('user.permission.update');
Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit');
Route::post('user/update', 'UserController@update')->name('user.update');
Route::post('user/store', 'UserController@store')->name('user.store');
Route::post('user/delete', 'UserController@delete')->name('user.delete');
Route::get('user/remove/image/{id}', 'UserController@romoveImage')->name('user.remove.image');

// Customer Route
Route::get('customer/search','CustomerController@search')->name('customer.search');
Route::get('customer/index', 'CustomerController@index')->name('customer.index');
Route::get('customer/edit/{id}', 'CustomerController@edit')->name('customer.edit');
Route::post('customer/update', 'CustomerController@update')->name('customer.update');
Route::post('customer/store', 'CustomerController@store')->name('customer.store');
Route::post('customer/delete', 'CustomerController@delete')->name('customer.delete');
Route::post('customer/send/sms', 'CustomerController@sendSms')
->name('customer.send.sms');

Route::get('customer/show/{id}', 'CustomerController@show')->name('customer.show');
Route::get('customer/show/filter/{id}', 'CustomerController@showFilter')->name('customer.show.filter');
Route::get('customer/cargo/excell/{id}', 'CustomerController@createExcell')->name('customer.cargo.excell');


// Receiver Route
Route::get('receiver/search','ReceiverController@search')->name('receiver.search');
Route::get('receiver/index', 'ReceiverController@index')->name('receiver.index');
Route::get('receiver/edit/{id}', 'ReceiverController@edit')->name('receiver.edit');
Route::get('receiver/show/{id}', 'ReceiverController@show')->name('receiver.show');
Route::get('receiver/show/filter/{id}', 'ReceiverController@showFilter')->name('receiver.show.filter');
Route::get('receiver/cargo/excell/{id}', 'ReceiverController@createExcell')->name('receiver.cargo.excell');
Route::post('receiver/update', 'ReceiverController@update')->name('receiver.update');
Route::post('receiver/store', 'ReceiverController@store')->name('receiver.store');
Route::post('receiver/delete', 'ReceiverController@delete')->name('receiver.delete');
Route::post('receiver/send/sms', 'ReceiverController@sendSms')
->name('receiver.send.sms');

// Product Route
Route::post('product/edit', 'ProductController@edit')->name('product.edit');
Route::post('product/update', 'ProductController@update')->name('product.update');
Route::post('product/store', 'ProductController@store')->name('product.store');
Route::post('product/delete', 'ProductController@delete')->name('product.delete');


// Cargo route
Route::get('cargo/search','CargoController@search')->name('cargo.search');
Route::post('cargo/store/all', 
	'CargoController@storeAll')->name('cargo.store.all');

Route::post('cargo/update/all', 
	'CargoController@updateAll')->name('cargo.update.all');

Route::get('cargo/print/{id}', 'CargoController@print')->name('cargo.print');

Route::get('cargo/index', 'CargoController@index')->name('cargo.index');
Route::get('cargo/create', 'CargoController@create')->name('cargo.create');
Route::get('cargo/show/{id}', 'CargoController@show')->name('cargo.show');
Route::post('cargo/update', 'CargoController@update')->name('cargo.update');
Route::post('cargo/store', 'CargoController@store')->name('cargo.store');
Route::post('cargo/delete', 'CargoController@delete')->name('cargo.delete');
Route::get('cargo/filter', 'CargoController@filter')->name('cargo.filter');
Route::post('cargo/changeStatus', 'CargoController@changeStatus')
->name('cargo.change.status');

Route::get('cargo/manafes', 'CargoController@manafesExcel')->name('cargo.manafes');


# City controller
Route::resource('settings/city','CityController');

# Servoce
Route::resource('settings/service','ServiceController');

# faq
Route::resource('settings/faq','FaqController');

# address
Route::resource('settings/address','AddressController');


// Cargo Status route
Route::get('settings/status/cargo/index', 'CargoStatusController@index')
->name('status.cargo.index');

Route::get('settings/status/cargo/create', 'CargoStatusController@create')
->name('status.cargo.create');

Route::post('settings/status/cargo/edit', 'CargoStatusController@edit')
->name('status.cargo.edit');

Route::post('settings/status/cargo/update', 'CargoStatusController@update')
->name('status.cargo.update');

Route::post('settings/status/cargo/store', 'CargoStatusController@store')
->name('status.cargo.store');

Route::post('settings/status/cargo/delete', 'CargoStatusController@delete')
->name('status.cargo.delete');

Route::get('status/log/index', 'CargoLogController@index')->name('cargo.log.index');
Route::get('status/log/store', 'CargoLogController@store')->name('cargo.log.store');

// company route
Route::get('settings/company/index', 'SettingsController@index')->name('settings.index');
Route::post('settings/company/update', 'SettingsController@update')->name('settings.update');

// page routes
Route::get('page/index', 'PageController@index')->name('page.index');
Route::get('page/edit/{id}', 'PageController@edit')->name('page.edit');
Route::post('page/update', 'PageController@update')->name('page.update');
Route::post('page/store', 'PageController@store')->name('page.store');
Route::post('page/delete', 'PageController@delete')->name('page.delete');


Route::get('clear','ClearController@index')->name('clear');


});