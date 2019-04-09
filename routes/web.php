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

Route::get('/', function () {
    return view('welcome');
});
Route::get('OS',function(){
	return view('orders.OrdersView');
});
Route::get('OS/instruction',function(){
	return view('orders.InsView');
});
Route::any('/test','RequestController@view');
Route::any('/request','RequestController@showRequest');
Route::get('mysql','MysqlController@index');
Route::get('mysql/read/{id}','MysqlController@read');
Route::get('mysql/create/{name}','MysqlController@create');
Route::get('mysql/update/{id}/{name}','MysqlController@update');
Route::get('mysql/delete/{id}','MysqlController@delete');

Route::get('orders/getValues/{date1?}/{date2?}','OrdersController@getValues');
Route::get('orders/read/{date1?}/{date2?}','OrdersController@read');
Route::get('orders/readProducts','OrdersController@readProducts');
Route::get('orders/test/{products_id}','OrdersController@setManufacturers');
Route::get('orders/getLatestUpdate','OrdersController@getLatestUpdate');
Route::get('orders/setCate','OrdersController@setCate');

Route::get('/sendmail','MailController@mail');