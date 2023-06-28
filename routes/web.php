<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------e------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
//Logout
Route::get('login', '\App\Http\Controllers\Auth\LoginController@login_page')->name('login');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::post('/change_password', '\App\Http\Controllers\Admin\UsersController@change_password')
             ->name('admin.user.change_password');

Route::get('/change_lang', '\App\Http\Controllers\WebsiteController@change_lang')
     ->name('change_lang');

Route::get('/','\App\Http\Controllers\WebsiteController@landing')->name('landing');
Route::get('/choose_business','\App\Http\Controllers\WebsiteController@choose_business')->name('choose_business');
Route::post('/select_business','\App\Http\Controllers\WebsiteController@select_business')->name('select_business');
Route::get('/register','\App\Http\Controllers\WebsiteController@register')->name('register');
Route::post('/register_external_user','\App\Http\Controllers\WebsiteController@register_external_user')->name('register_external_user');

Route::post('send_verification_code', '\App\Http\Controllers\WebsiteController@send_verification_code')->name('send_verification_code');
Route::post('login_json', '\App\Http\Controllers\WebsiteController@login_json')->name('login_json');
Route::post('create_external_user', '\App\Http\Controllers\WebsiteController@create_external_user')->name('create_external_user');

Route::post('create_external_business', '\App\Http\Controllers\WebsiteController@create_external_business')->name('create_external_business');

//Web-site routes

Route::get('/get_current_date','\App\Http\Controllers\WebsiteController@get_current_date')->name('get_current_date');
Route::get('/terms_and_conditions','\App\Http\Controllers\WebsiteController@terms_and_conditions')->name('terms_and_conditions');
Route::get('/license','\App\Http\Controllers\WebsiteController@license')->name('license');
Route::post('/api/get_location','\App\Http\Controllers\WebsiteController@get_location')->name('get_location');

Route::post('get_recaptcha', '\App\Http\Controllers\WebsiteController@get_recaptcha')->name('get_recaptcha');
Route::post('check_user_session', '\App\Http\Controllers\WebsiteController@check_user_session')->name('check_user_session');
Route::post('get_session_idle_time', '\App\Http\Controllers\WebsiteController@get_session_idle_time')->name('get_session_idle_time');
Route::post('clear_user_session', '\App\Http\Controllers\WebsiteController@clear_user_session')->name('clear_user_session');

Route::post('login_api', '\App\Http\Controllers\Auth\LoginController@login_api')->name('login_api');

Route::get('/dashboard','\App\Http\Controllers\Admin\LandingController@application_dashboard')->name('dashboard');

Route::group(
    [   'middleware' => ['auth'],
        'prefix' => 'admin/users',
    ], function () {

        Route::get('/', '\App\Http\Controllers\Admin\UsersController@index')
             ->name('admin.user.index');

        Route::post('/filter','\App\Http\Controllers\Admin\UsersController@filter')
            ->name('admin.user.filter');

        Route::get('/create','\App\Http\Controllers\Admin\UsersController@create')
             ->name('admin.user.create');

        Route::get('/show/{user}','\App\Http\Controllers\Admin\UsersController@show')
             ->name('admin.user.show')
             ->where('id', '[0-9]+');

        Route::get('/{user}/edit','\App\Http\Controllers\Admin\UsersController@edit')
             ->name('admin.user.edit');

       Route::get('/{user}/edit_role','\App\Http\Controllers\Admin\UsersController@edit_role')
            ->name('admin.user.edit_role');

        Route::post('/', '\App\Http\Controllers\Admin\UsersController@store')
             ->name('admin.user.store');

        Route::put('user/{user}', '\App\Http\Controllers\Admin\UsersController@update')
             ->name('admin.user.update');

         Route::put('user_role/{user}', '\App\Http\Controllers\Admin\UsersController@update_role')
              ->name('admin.user.update_role');

        Route::delete('/user/{user}','\App\Http\Controllers\Admin\UsersController@destroy')
             ->name('admin.user.destroy');

       Route::get('/recover/{user}','\App\Http\Controllers\Admin\UsersController@recover')
            ->name('admin.user.recover');

       Route::get('/lock/{user}','\App\Http\Controllers\Admin\UsersController@lock')
            ->name('admin.user.lock');

       Route::get('/unlock/{user}','\App\Http\Controllers\Admin\UsersController@unlock')
            ->name('admin.user.unlock');

      Route::get('/log_out/{user}','\App\Http\Controllers\Admin\UsersController@log_out')
           ->name('admin.user.log_out');


    });


    Route::group(
    [   'middleware' => ['auth'],
        'prefix' => 'admin/roles',
    ], function () {

        Route::get('/', '\App\Http\Controllers\Admin\RolesController@index')
             ->name('admin.role.index');

        Route::get('/create','\App\Http\Controllers\Admin\RolesController@create')
             ->name('admin.role.create');

        Route::get('/show/{role}','\App\Http\Controllers\Admin\RolesController@show')
             ->name('admin.role.show');

        Route::get('/{role}/edit','\App\Http\Controllers\Admin\RolesController@edit')
             ->name('admin.role.edit');

        Route::post('/', '\App\Http\Controllers\Admin\RolesController@store')
             ->name('admin.role.store');

        Route::put('role/{role}', '\App\Http\Controllers\Admin\RolesController@update')
             ->name('admin.role.update');

        Route::delete('/role/{role}','\App\Http\Controllers\Admin\RolesController@destroy')
             ->name('admin.role.destroy');

    });

    Route::group(
    [
        'middleware' => ['auth'],
        'prefix' => 'admin/permissions',
    ], function () {

        Route::get('/', '\App\Http\Controllers\Admin\PermissionsController@index')
             ->name('admin.permission.index');

        Route::get('/create','\App\Http\Controllers\Admin\PermissionsController@create')
             ->name('admin.permission.create');

        Route::get('/show/{permission}','\App\Http\Controllers\Admin\PermissionsController@show')
             ->name('admin.permission.show');

        Route::get('/{permission}/edit','\App\Http\Controllers\Admin\PermissionsController@edit')
             ->name('admin.permission.edit');

        Route::post('/', '\App\Http\Controllers\Admin\PermissionsController@store')
             ->name('admin.permission.store');

        Route::put('permission/{permission}', '\App\Http\Controllers\Admin\PermissionsController@update')
             ->name('admin.permission.update');

        Route::delete('/permission/{permission}','\App\Http\Controllers\Admin\PermissionsController@destroy')
             ->name('admin.permission.destroy');

});

Route::group([
    'prefix' => 'admin/logs',
], function () {
    Route::get('/', '\App\Http\Controllers\LogsController@index')
         ->name('admin.logs.log.index');
    Route::get('/create','\App\Http\Controllers\LogsController@create')
         ->name('admin.logs.log.create');
    Route::get('/show/{log}','\App\Http\Controllers\LogsController@show')
         ->name('admin.logs.log.show')->where('id', '[0-9]+');
    Route::get('/{log}/edit','\App\Http\Controllers\LogsController@edit')
         ->name('admin.logs.log.edit')->where('id', '[0-9]+');
    Route::post('/', '\App\Http\Controllers\LogsController@store')
         ->name('admin.logs.log.store');
    Route::put('log/{log}', '\App\Http\Controllers\LogsController@update')
         ->name('admin.logs.log.update')->where('id', '[0-9]+');
    Route::delete('/log/{log}','\App\Http\Controllers\LogsController@destroy')
         ->name('admin.logs.log.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'admin/countries',
], function () {
    Route::get('/', 'App\Http\Controllers\CountriesController@index')
         ->name('admin.countries.country.index');
    Route::get('/create','App\Http\Controllers\CountriesController@create')
         ->name('admin.countries.country.create');
    Route::get('/show/{country}','App\Http\Controllers\CountriesController@show')
         ->name('admin.countries.country.show')->where('id', '[0-9]+');
    Route::get('/{country}/edit','App\Http\Controllers\CountriesController@edit')
         ->name('admin.countries.country.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\CountriesController@store')
         ->name('admin.countries.country.store');
    Route::put('country/{country}', 'App\Http\Controllers\CountriesController@update')
         ->name('admin.countries.country.update')->where('id', '[0-9]+');
    Route::delete('/country/{country}','App\Http\Controllers\CountriesController@destroy')
         ->name('admin.countries.country.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'admin/regions',
], function () {
    Route::get('/', 'App\Http\Controllers\RegionsController@index')
         ->name('admin.regions.region.index');
    Route::get('/create','App\Http\Controllers\RegionsController@create')
         ->name('admin.regions.region.create');
    Route::get('/show/{region}','App\Http\Controllers\RegionsController@show')
         ->name('admin.regions.region.show')->where('id', '[0-9]+');
    Route::get('/{region}/edit','App\Http\Controllers\RegionsController@edit')
         ->name('admin.regions.region.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\RegionsController@store')
         ->name('admin.regions.region.store');
    Route::put('region/{region}', 'App\Http\Controllers\RegionsController@update')
         ->name('admin.regions.region.update')->where('id', '[0-9]+');
    Route::delete('/region/{region}','App\Http\Controllers\RegionsController@destroy')
         ->name('admin.regions.region.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'admin/districts',
], function () {
    Route::get('/', 'App\Http\Controllers\DistrictsController@index')
         ->name('admin.districts.district.index');
    Route::get('/create','App\Http\Controllers\DistrictsController@create')
         ->name('admin.districts.district.create');
    Route::get('/show/{district}','App\Http\Controllers\DistrictsController@show')
         ->name('admin.districts.district.show')->where('id', '[0-9]+');
    Route::get('/{district}/edit','App\Http\Controllers\DistrictsController@edit')
         ->name('admin.districts.district.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\DistrictsController@store')
         ->name('admin.districts.district.store');
    Route::put('district/{district}', 'App\Http\Controllers\DistrictsController@update')
         ->name('admin.districts.district.update')->where('id', '[0-9]+');
    Route::delete('/district/{district}','App\Http\Controllers\DistrictsController@destroy')
         ->name('admin.districts.district.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'admin/user_login_logs',
], function () {
    Route::get('/', 'App\Http\Controllers\UserLoginLogsController@index')
         ->name('admin.user_login_logs.user_login_log.index');
    Route::get('/create','App\Http\Controllers\UserLoginLogsController@create')
         ->name('admin.user_login_logs.user_login_log.create');
    Route::get('/show/{userLoginLog}','App\Http\Controllers\UserLoginLogsController@show')
         ->name('admin.user_login_logs.user_login_log.show')->where('id', '[0-9]+');
    Route::get('/{userLoginLog}/edit','App\Http\Controllers\UserLoginLogsController@edit')
         ->name('admin.user_login_logs.user_login_log.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\UserLoginLogsController@store')
         ->name('admin.user_login_logs.user_login_log.store');
    Route::put('user_login_log/{userLoginLog}', 'App\Http\Controllers\UserLoginLogsController@update')
         ->name('admin.user_login_logs.user_login_log.update')->where('id', '[0-9]+');
    Route::delete('/user_login_log/{userLoginLog}','App\Http\Controllers\UserLoginLogsController@destroy')
         ->name('admin.user_login_logs.user_login_log.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'admin/system_settings',
], function () {
    Route::get('/', 'App\Http\Controllers\SystemSettingsController@index')
         ->name('admin.system_settings.system_setting.index');
    Route::get('/create','App\Http\Controllers\SystemSettingsController@create')
         ->name('admin.system_settings.system_setting.create');
    Route::get('/show/{systemSetting}','App\Http\Controllers\SystemSettingsController@show')
         ->name('admin.system_settings.system_setting.show')->where('id', '[0-9]+');
    Route::get('/{systemSetting}/edit','App\Http\Controllers\SystemSettingsController@edit')
         ->name('admin.system_settings.system_setting.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\SystemSettingsController@store')
         ->name('admin.system_settings.system_setting.store');
    Route::put('system_setting/{systemSetting}', 'App\Http\Controllers\SystemSettingsController@update')
         ->name('admin.system_settings.system_setting.update')->where('id', '[0-9]+');
    Route::delete('/system_setting/{systemSetting}','App\Http\Controllers\SystemSettingsController@destroy')
         ->name('admin.system_settings.system_setting.destroy')->where('id', '[0-9]+');
});

Route::group([
     'prefix' => 'admin/businesses',
 ], function () {
     Route::get('/', 'App\Http\Controllers\BusinessesController@index')
          ->name('admin.businesses.business.index');
     Route::get('/create','App\Http\Controllers\BusinessesController@create')
          ->name('admin.businesses.business.create');
     Route::get('/show/{business}','App\Http\Controllers\BusinessesController@show')
          ->name('admin.businesses.business.show')->where('id', '[0-9]+');
     Route::get('/{business}/edit','App\Http\Controllers\BusinessesController@edit')
          ->name('admin.businesses.business.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\BusinessesController@store')
          ->name('admin.businesses.business.store');
     Route::put('business/{business}', 'App\Http\Controllers\BusinessesController@update')
          ->name('admin.businesses.business.update')->where('id', '[0-9]+');
     Route::delete('/business/{business}','App\Http\Controllers\BusinessesController@destroy')
          ->name('admin.businesses.business.destroy')->where('id', '[0-9]+');

     Route::get('/download-certificate/{business}', 'App\Http\Controllers\BusinessesController@download_certificate')
          ->name('admin.businesses.business.download_certificate');

 });

 Route::group([
     'prefix' => 'admin/items',
 ], function () {
     Route::get('/', 'App\Http\Controllers\ItemsController@index')
          ->name('admin.items.item.index');
     Route::get('/create','App\Http\Controllers\ItemsController@create')
          ->name('admin.items.item.create');
     Route::get('/show/{item}','App\Http\Controllers\ItemsController@show')
          ->name('admin.items.item.show')->where('id', '[0-9]+');
     Route::get('/{item}/edit','App\Http\Controllers\ItemsController@edit')
          ->name('admin.items.item.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\ItemsController@store')
          ->name('admin.items.item.store');
     Route::put('item/{item}', 'App\Http\Controllers\ItemsController@update')
          ->name('admin.items.item.update')->where('id', '[0-9]+');
     Route::delete('/item/{item}','App\Http\Controllers\ItemsController@destroy')
          ->name('admin.items.item.destroy')->where('id', '[0-9]+');

 });

 Route::group([
     'prefix' => 'admin/transaction_categories',
 ], function () {
     Route::get('/', 'App\Http\Controllers\TransactionCategoriesController@index')
          ->name('admin.transaction_categories.transaction_category.index');
     Route::get('/create','App\Http\Controllers\TransactionCategoriesController@create')
          ->name('admin.transaction_categories.transaction_category.create');
     Route::get('/show/{transaction_category}','App\Http\Controllers\TransactionCategoriesController@show')
          ->name('admin.transaction_categories.transaction_category.show')->where('id', '[0-9]+');
     Route::get('/{transaction_category}/edit','App\Http\Controllers\TransactionCategoriesController@edit')
          ->name('admin.transaction_categories.transaction_category.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\TransactionCategoriesController@store')
          ->name('admin.transaction_categories.transaction_category.store');
     Route::put('transaction_category/{transaction_category}', 'App\Http\Controllers\TransactionCategoriesController@update')
          ->name('admin.transaction_categories.transaction_category.update')->where('id', '[0-9]+');
     Route::delete('/transaction_category/{transaction_category}','App\Http\Controllers\TransactionCategoriesController@destroy')
          ->name('admin.transaction_categories.transaction_category.destroy')->where('id', '[0-9]+');

     Route::post('/get_transaction_categories_from_type', 'App\Http\Controllers\TransactionCategoriesController@get_transaction_categories_from_type')
          ->name('admin.transaction_categories.transaction_category.get_transaction_categories_from_type');

     Route::post('/get_transaction_categories_from_category', 'App\Http\Controllers\TransactionCategoriesController@get_transaction_categories_from_category')
          ->name('admin.transaction_categories.transaction_category.get_transaction_categories_from_category');


 });

 Route::group([
     'prefix' => 'admin/units',
 ], function () {
     Route::get('/', 'App\Http\Controllers\UnitsController@index')
          ->name('admin.units.unit.index');
     Route::get('/create','App\Http\Controllers\UnitsController@create')
          ->name('admin.units.unit.create');
     Route::get('/show/{unit}','App\Http\Controllers\UnitsController@show')
          ->name('admin.units.unit.show')->where('id', '[0-9]+');
     Route::get('/{unit}/edit','App\Http\Controllers\UnitsController@edit')
          ->name('admin.units.unit.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\UnitsController@store')
          ->name('admin.units.unit.store');
     Route::put('unit/{unit}', 'App\Http\Controllers\UnitsController@update')
          ->name('admin.units.unit.update')->where('id', '[0-9]+');
     Route::delete('/unit/{unit}','App\Http\Controllers\UnitsController@destroy')
          ->name('admin.units.unit.destroy')->where('id', '[0-9]+');

 });

 Route::group([
     'prefix' => 'admin/transactions',
 ], function () {
     Route::get('/', 'App\Http\Controllers\TransactionsController@index')
          ->name('admin.transactions.transaction.index');

     Route::get('/create','App\Http\Controllers\TransactionsController@create')
          ->name('admin.transactions.transaction.create');

     Route::get('/show/{transaction}','App\Http\Controllers\TransactionsController@show')
          ->name('admin.transactions.transaction.show')->where('id', '[0-9]+');

     Route::get('/{transaction}/edit','App\Http\Controllers\TransactionsController@edit')
          ->name('admin.transactions.transaction.edit')->where('id', '[0-9]+');

     Route::post('/', 'App\Http\Controllers\TransactionsController@store')
          ->name('admin.transactions.transaction.store');

     Route::put('transaction/{transaction}', 'App\Http\Controllers\TransactionsController@update')
          ->name('admin.transactions.transaction.update')->where('id', '[0-9]+');

     Route::delete('/transaction/{transaction}','App\Http\Controllers\TransactionsController@destroy')
          ->name('admin.transactions.transaction.destroy')->where('id', '[0-9]+');

 });

 Route::group([
     'prefix' => 'admin/reports',
 ], function () {

     Route::get('/profit_and_loss', 'App\Http\Controllers\ReportsController@profit_and_loss')
          ->name('admin.reports.report.profit_and_loss');

 });

 Route::group([
     'prefix' => 'admin/sales',
 ], function () {
     Route::get('/', 'App\Http\Controllers\TransactionsController@index_sale')
          ->name('admin.sales.sale.index');

     Route::get('/add-new-sale/{itemId}','App\Http\Controllers\TransactionsController@create_sale')
          ->name('admin.sales.sale.create');

     Route::get('/{transaction}/edit-sale/{itemId}','App\Http\Controllers\TransactionsController@edit_sale')
          ->name('admin.sales.sale.edit')->where('id', '[0-9]+');

 });

  Route::group([
     'prefix' => 'admin/purchases',
 ], function () {
     Route::get('/', 'App\Http\Controllers\TransactionsController@index_purchase')
          ->name('admin.purchases.purchase.index');

     Route::get('/add-new-purchase/{itemId}','App\Http\Controllers\TransactionsController@create_purchase')
          ->name('admin.purchases.purchase.create');

     Route::get('/{transaction}/edit-purchase/{itemId}','App\Http\Controllers\TransactionsController@edit_purchase')
          ->name('admin.purchases.purchase.edit')->where('id', '[0-9]+');

 });


 Route::group([
     'prefix' => 'admin/capitals',
 ], function () {
     Route::get('/', 'App\Http\Controllers\TransactionsController@index_capital')
          ->name('admin.capitals.capital.index');

     Route::get('/add-new-capital','App\Http\Controllers\TransactionsController@create_capital')
          ->name('admin.capitals.capital.create');

     Route::get('/{transaction}/edit-capital/{itemId}','App\Http\Controllers\TransactionsController@edit_capital')
          ->name('admin.capitals.capital.edit')->where('id', '[0-9]+');

 });
