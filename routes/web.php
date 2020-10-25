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

Route::get(config('constants.ADMIN_PREFIX'), 'AdminController@loginView');
Route::get(config('constants.ADMIN_PREFIX') . '/login', 'AdminController@loginView');
Route::post(config('constants.ADMIN_PREFIX') . '/login', 'AdminController@login');
Route::get(config('constants.ADMIN_PREFIX') . '/logout', 'AdminController@logout');

Route::group(['prefix' => 'sa', 'middleware' => ['adminLogin']], function () {
	Route::post('uploadImage', 'SettingController@uploadSingleImage');
	Route::post('deleteImage', 'SettingController@deleteSingleImage');
	Route::get('advisory', 'SettingController@getAdvisoryView');

	Route::group(['prefix' => 'order'], function () {
		Route::get('', 'Admin_OrderController@getAllOrders');

		Route::get('create', 'Admin_OrderController@createOrderView');
		Route::post('createPost', 'Admin_OrderController@createOrder');

		Route::post('search', 'Admin_OrderController@searchOrder');
		Route::get('/{Id}', 'Admin_OrderController@orderDetailView');
		Route::post('edit', 'Admin_OrderController@editOrder');

		Route::post('sendEmailRemindOrder', 'Admin_OrderController@sendEmailRemindOrder');
	});

	Route::group(['prefix' => 'account'], function () {
		Route::get('', 'Admin_AccountController@getAllUsers');

		Route::get('create', 'Admin_AccountController@createUserView');
		Route::post('createPost', 'Admin_AccountController@createUser');

		Route::get('/{Id}', 'Admin_AccountController@editUserView');
		Route::post('editPost', 'Admin_AccountController@editUserPost');

		Route::post('changePasswordPost/{Id}', 'Admin_AccountController@changePasswordPost');
	});

	Route::group(['prefix' => 'permissions'], function () {
		Route::get('', 'Admin_AccountController@getAllPermissions');
		Route::post('editPost', 'Admin_AccountController@editPermissionsPost');
	});

	Route::group(['prefix' => 'driver'], function () {
		Route::get('', 'SettingController@getAllDrivers');

		Route::post('createPost', 'SettingController@createDriver');
		Route::post('editPost', 'SettingController@editDriver');
		Route::post('delete', 'SettingController@deleteDriver');
	});

	Route::group(['prefix' => 'tour'], function () {
		Route::get('', 'SettingController@getAllTours');

		Route::post('createPost', 'SettingController@createTour');
		Route::post('editPost', 'SettingController@editTour');
		Route::post('delete', 'SettingController@deleteTour');
	});

	
	Route::group(['prefix' => 'car'], function () {
		Route::get('', 'SettingController@getAllCars');

		Route::post('createPost', 'SettingController@createCar');
		Route::post('editPost', 'SettingController@editCar');
		Route::post('delete', 'SettingController@deleteCar');
	});
});

Route::get('/', 'HomeController@homeView');
Route::get('tour', 'HomeController@tourView');
Route::post('createOrder', 'HomeController@createOrder');