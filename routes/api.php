<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// CMS Pages
Route::get('cms-pages', [CommonController::class, 'cmsPages']);
Route::get('general-info', 'Api\CommonController@generalInformation');


Route::prefix('customer')->group( function() {
    Route::post('login', 'Api\Customer\Auth\AuthController@login');
    Route::post('logout', 'Api\Customer\Auth\PasswordResetController@logout');

	
	
    Route::middleware(['auth:api'])->group( function () {
		// Banners
		Route::get('banners', 'Api\Customer\BannersController@index');
		Route::get('orderBanners', 'Api\Customer\BannersController@order_banners');
		
		// Dashboard
		Route::get('get_dashboardData', 'Api\Customer\DasboardController@index');

		// Create Order
		Route::post('createOrder', 'Api\Customer\OrderController@create');
		Route::post('completeOrder', 'Api\Customer\OrderController@complete');

		//USER
		Route::get('get_myProfile', 'Api\Customer\UserController@profile');
		Route::post('updateProfile', 'Api\Customer\UserController@update');
		Route::post('update_deviceToken', 'Api\Customer\UserController@update_deviceToken');
		Route::get('logout', 'Api\Customer\Auth\AuthController@logout');

		// SETTINGS
		Route::post('save_generalSettings', 'Api\Customer\UserController@savegeneralSettings');
		Route::get('get_generalSettings', 'Api\Customer\UserController@getgeneralSettings');
    });
    
    // PRODUCTS
    Route::post('get_categoryProducts','Api\Customer\ProductController@categoryProducts');
});