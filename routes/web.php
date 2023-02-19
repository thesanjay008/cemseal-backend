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

//Localization route
Route::get('lang/{locale}', 'HomeController@lang')->name('locale');


// LOGIN / REGISTRATION
Auth::routes();
Route::post('/loginUser', 'Auth\LoginController@loginUser')->name('loginUser');
Route::post('/registerUser', 'Auth\RegisterController@register')->name('registerUser');
Route::get('/recover-password','Auth\RecoverPasswordController@recover_password')->name('recoverPassword');
Route::post('/recover-password','Auth\RecoverPasswordController@ajax_recover_password')->name('ajax.recover.password');

// FRONT
Route::get('/', 'HomeController@index')->name('firstPage');
Route::get('/menu', 'theme\MenuController@index')->name('menuPage');
Route::get('/checkout', 'theme\CheckoutController@index')->name('checkoutPage');


Route::get('/about-us', 'CmsController@aboutUs')->name('about-us');
Route::get('/qr-code', 'CmsController@qrCode')->name('qr-code');
Route::get('/contact-us', 'CmsController@contactUs')->name('contact-us');
Route::get('/terms', 'CmsController@terms')->name('terms');
Route::get('/privacy', 'CmsController@privacy')->name('privacy');
Route::get('/refund', 'CmsController@refund')->name('refund');
Route::get('/restaurants', 'RestaurantController@index')->name('restaurantList');
Route::post('/restaurants', 'RestaurantController@ajax')->name('ajax_restaurantList');
Route::get('/restaurants/{id?}', 'RestaurantController@show')->name('restaurantView');

// ORDER
Route::post('/checkNewOrder', 'HomeController@ajax_checkNewOrder')->name('checkNewOrder');
Route::post('/addtoCart', 'CartController@ajax_add')->name('addtoCart');
Route::post('/delete_cart', 'CartController@deleteCart')->name('deleteCart');
Route::post('/cartList', 'CartController@ajax_list')->name('cartList');
Route::post('/create-order', 'theme\OrderController@create')->name('createOrder');
Route::get('/confirm-order', 'theme\OrderController@confirm')->name('confirmOrder');
Route::get('/order-success', 'theme\OrderController@orderSuccess')->name('order_successPage');
Route::get('/order-failed', 'theme\OrderController@orderFailed')->name('order_failedPage');

// MY Account
Route::post('/loginPortal', 'Auth\LoginController@loginUser')->name('loginPortal');
Route::get('/my-account', 'AccountController@index')->name('myAccount');
Route::get('/my-account/orders', 'AccountController@myOrders')->name('myOrders');
Route::get('/my-account/wish-list', 'AccountController@wishList')->name('myWishList');
Route::get('/profile-settings', 'AccountController@settings')->name('profileSettings');
Route::post('/saveAddress', 'AccountController@ajax_saveAddress')->name('saveAddress');

Route::post('/updateProfile', 'AccountController@updateProfile')->name('updateProfile');
Route::post('/ajax_myOrders', 'AccountController@ajax_myOrders')->name('ajax_myOrders');


// COMMON
Route::post('country/list','CountryController@store')->name('countryList');
Route::post('state/list','StateController@list')->name('stateList');
Route::post('city/list','CityController@list')->name('cityList');

// DEVELOPER
Route::group(['middleware' => ['auth'],'prefix' => 'developer','namespace' => 'Developer'], function() {
    Route::get('/','HomeController@index')->name('developerDashboard');
	Route::resource('roles','RoleController');
	Route::resource('permissions','PermissionController')->except(['show','edit','update']);
});


// BACKEND
Route::group(['middleware' => ['auth'],'prefix' => 'backend','namespace' => 'Backend'], function() {
	Route::get('/','HomeController@index')->name('homePage');
	Route::get('/dashboard','HomeController@index')->name('dashboard');
	
	// Auth
	Route::get('/change-password','ProfileController@change_password')->name('change_password');
	Route::post('/change-password','ProfileController@ajax_change_password')->name('changePassword');
	
	// USERS
	Route::resource('users', 'UserController');
	Route::post('/users/ajax','UserController@ajax')->name('ajax_user_list');
	Route::post('/saveUser','UserController@store')->name('ajax_saveUser');
	Route::post('/user/status','UserController@change_status')->name('ajax_change_userStatus');
	Route::post('/delete_user','UserController@destroy')->name('ajax_delete_user');
	
	// ORDERS
	Route::resource('orders', 'OrderController');
	Route::post('/orders/ajax','OrderController@ajax')->name('orderList');
	Route::post('/orders/status','OrderController@status')->name('orders_status');
	Route::post('/orderCount', 'OrderController@ajax_count')->name('ajax_orderCount');
	Route::post('/checkNewOrders', 'OrderController@ajax_checkNewOrders')->name('ajax_checkNewOrders');
	
	// PRODUCT
	Route::resource('products', 'ProductController');
	Route::post('/products/ajax','ProductController@ajax')->name('productList');
	Route::post('/saveProduct','ProductController@store')->name('saveProduct');
	Route::post('/deleteProduct','ProductController@destroy')->name('deleteProduct');
	
	
	// Outlets 
	Route::resource('outlets', 'OutletController');
	Route::post('/outlets/ajax','OutletController@ajax')->name('ajax_outlet_list');
	Route::post('/saveOutlet','OutletController@store')->name('ajax_saveOutlet');
	Route::post('/updateOutlet','OutletController@update')->name('ajax_updateOutlet');
	Route::post('/outlet/status','OutletController@change_status')->name('ajax_change_outletStatus');
	
	// Table
	Route::resource('table', 'TableController');
	Route::post('/table/ajax','TableController@ajax')->name('ajax_table_list');
	Route::post('/saveTable','TableController@store')->name('ajax_saveTable');
	Route::post('/updateTable','TableController@update')->name('ajax_updateTable');
	Route::post('/table/status','TableController@change_status')->name('ajax.change.table.tatus');
	
	// Banners
	Route::resource('banners', 'BannerController');
	Route::post('/banner/ajax','BannerController@ajax')->name('ajax_banner_list');
	Route::post('/saveTable','BannerController@store')->name('ajax_saveBanner');
	Route::post('/updateTable','BannerController@update')->name('ajax_updateBanner');
	Route::post('/table/status','BannerController@change_status')->name('ajax_change_bannerStatus');
	Route::post('/deleteBanner','BannerController@destroy')->name('ajax_deleteBanner');
	
	// SETTINGS
	Route::get('/general-settings','SettingController@general_settings')->name('general-settings');
	Route::post('/general-setting/store','SettingController@store')->name('ajax.store.general-settings');
	Route::post('/general-setting/store-qr','SettingController@store_qr')->name('ajax.store.qr-code');
	Route::get('/paymentGateways','PaymentGatewayController@index')->name('paymentGateways');
	Route::post('/paymentGateway/list','PaymentGatewayController@ajax')->name('ajax.paymentGateway.list');
	Route::post('/paymentGateway/edit','PaymentGatewayController@ajax')->name('paymentGateway.edit');
	Route::post('/paymentGateway/status','PaymentGatewayController@change_status')->name('change.paymentGateway.status');
});


// SUPERADMIN
Route::group(['middleware' => ['auth','verified'],'prefix' => 'admin','namespace' => 'Admin'], function() {
    Route::get('/','HomeController@index')->name('home');
    Route::get('/data','HomeController@data')->name('data');

    // Categories 
	Route::resource('categories', 'CategoryController');
	Route::post('/category/ajax','CategoryController@ajax')->name('categories_list');
	Route::post('/delete_categories','CategoryController@destroy')->name('delete_categories');

	// Vendors 
	Route::resource('restaurants', 'RestaurantController');
	Route::post('/restaurants/ajax','RestaurantController@ajax')->name('restaurants_list');
	Route::post('/saveRestaurants','RestaurantController@store')->name('saveRestaurants');
	Route::post('/updateRestaurants','RestaurantController@update')->name('updateRestaurant');
	Route::post('/restaurants/status','RestaurantController@restaurant_status')->name('restaurants_status');
});


// VENDORS
Route::group(['middleware' => ['auth','verified'],'prefix' => 'vendors','namespace' => 'Vendors'], function() {
    Route::get('/','HomeController@index')->name('vendorHome');
    Route::get('/dashboard','HomeController@dashboard')->name('vendorDashboard');
	
	// Update Restraunts
	Route::get('/edit', 'RestaurantController@edit')->name('vendorEdit');
	Route::Post('/update', 'RestaurantController@update')->name('vendorUpdate');
	
		
	// Category menu 
	Route::resource('menu_categories', 'MenuCategoryController');
	Route::post('/menu_category/ajax','MenuCategoryController@ajax')->name('menu_catergories_list');
	Route::post('/delete_menu_categories','MenuCategoryController@destroy')->name('delete_menu_categories');

	// Addon Groups 
	//Route::resource('addon_groups', 'AddonGroupController');
	//Route::post('/addon_groups/ajax','AddonGroupController@ajax')->name('addon_groups_list');
	//Route::post('/delete_addon_group','AddonGroupController@destroy')->name('delete_addon_group');

	// Addon 
	//Route::resource('addons', 'AddonController');
	//Route::post('/addons/ajax','AddonController@ajax')->name('addons_list');
	//Route::post('/delete_addon','AddonController@destroy')->name('delete_addon');
	
	// Coupon 
	Route::resource('coupons', 'CouponController');
	Route::post('/coupon/ajax','CouponController@ajax')->name('coupons_list');
	Route::post('/delete_coupons','CouponController@destroy')->name('delete_coupons');
	
});

// SUPPORT
Route::get('clear', 'SupportController@clear_cache');
Route::get('caches', 'SupportController@caches');
Route::get('migrate', 'SupportController@migration');
Route::get('seed', 'SupportController@seeding');