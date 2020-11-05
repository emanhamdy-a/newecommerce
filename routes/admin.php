<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

		Config::set('auth.defines', 'admin');
		Route::get('login', 'AdminAuth@login');
		Route::post('login', 'AdminAuth@dologin');
		Route::get('forgot/password', 'AdminAuth@forgot_password');
		Route::post('forgot/password', 'AdminAuth@forgot_password_post');
		Route::get('reset/password/{token}', 'AdminAuth@reset_password');
    Route::post('reset/password/{token}', 'AdminAuth@reset_password_final');

    Route::get('/insert_db', function () {
      return view('seeder');
    });
    Route::group(['middleware' => 'admin:admin'], function () {

      Route::get('/echo_db', function () {
        return view('heroku_db');
      });

    Route::resource('admins', 'AdminController');
    Route::get('admins/delete/{delete}', 'AdminController@delete');
    Route::any('admins/destroy/all', 'AdminController@multi_delete');

    Route::resource('users', 'UsersController');
    Route::get('users/delete/{delete}', 'UsersController@delete');

    Route::any('users/destroy/all', 'UsersController@multi_delete');

    Route::resource('countries', 'CountriesController');
    Route::get('countries/delete/{delete}', 'CountriesController@delete');
    Route::delete('countries/destroy/all', 'CountriesController@multi_delete');

    Route::resource('currencies',
     'CurrenciesController');
     Route::get('currencies/delete/{delete}', 'CurrenciesController@delete');
    Route::delete('currencies/destroy/all',
    'CurrenciesController@multi_delete');


    Route::resource('trademarks', 'TradeMarksController');
    Route::get('trademarks/delete/{delete}', 'TradeMarksController@delete');
    Route::delete('trademarks/destroy/all', 'TradeMarksController@multi_delete');
    Route::resource('departments', 'DepartmentsController');

    Route::resource('manufactures', 'ManufacturesController');
    Route::get('manufactures/delete/{delete}', 'ManufacturesController@delete');
    Route::delete('manufactures/destroy/all', 'ManufacturesController@multi_delete');

    Route::resource('shipping', 'ShippingController');
    Route::get('shipping/delete/{delete}','ShippingController@delete');
    Route::delete('shipping/destroy/all', 'ShippingController@multi_delete');

    Route::resource('merchants', 'MerchantsController');
    Route::get('merchants/delete/{delete}', 'MerchantsController@delete');
    Route::delete('merchants/destroy/all', 'MerchantsController@multi_delete');

    Route::resource('colors', 'ColorsController');
    Route::get('colors/delete/{delete}', 'ColorsController@delete');
    Route::delete('colors/destroy/all', 'ColorsController@multi_delete');

    Route::resource('sizes', 'SizesController');
    Route::get('sizes/delete/{delete}', 'SizesController@delete');
    Route::delete('sizes/destroy/all', 'SizesController@multi_delete');

    Route::resource('weights', 'WeightsController');
    Route::get('weights/delete/{delete}', 'WeightsController@delete');
    Route::delete('weights/destroy/all', 'WeightsController@multi_delete');

    Route::get('logout', 'AdminAuth@logout');

    Route::resource('products', 'ProductsController');
    Route::delete('products/destroy/all', 'ProductsController@multi_delete');
    Route::get('products/delete/{delete}', 'ProductsController@deleteProduct');

    Route::post('products/search','ProductsController@product_search');

    Route::post('products/copy/{pid}', 'ProductsController@copy_product');
    Route::post('upload/image/{pid}','ProductsController@upload_file');
    Route::post('delete/image', 'ProductsController@delete_file');
    Route::post('update/image/{pid}', 'ProductsController@update_product_image');
    Route::post('delete/product/image/{pid}', 'ProductsController@delete_main_image');
    Route::post('load/wight/size', 'ProductsController@prepare_weight_size');

    Route::get('/dashboard', function () {
        return view('admin.home');
    });

    Route::get('/', function () {
        return view('admin.home');
    });


    Route::get('settings', 'Settings@setting');
    Route::post('settings', 'Settings@setting_save');

  });

  Route::get('lang/{lang}', function ($lang) {
      session()->has('lang')?session()->forget('lang'):'';
      $lang == 'ar'?session()->put('lang', 'ar'):session()->put('lang', 'en');
      return back();
  });

});

Route::get('scan/empty/product', function () {
  $clear_product = \App\Jobs\ClearEmptyProduct::dispatch();
  return dd($clear_product);
});
