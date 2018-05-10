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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// route for view/blade file
// Route::get('paywithpaypal', array('as' => 'paywithpaypal','uses' => 'PayPalController@payWithPaypal',));
// // route for post request
// Route::post('paypal', array('as' => 'paypal','uses' => 'PayPalController@postPaymentWithpaypal',));
// // route for check status responce
// Route::get('paypal', array('as' => 'status','uses' => 'PayPalController@getPaymentStatus',));
// //YAJRA DATATABLE CONTROLLER........................................................................................................................................................
// Route::get('getindex','DatatablesController@getIndex')->name('getindex');

// Route::get('data','DatatablesController@anyData')->name('data');
// Route::get('delete/{id}','DatatablesController@deleteRecord')->name('delete');
// Route::get('edit/{id}','DatatablesController@editRecord')->name('edit');
// Route::post('update','DatatablesController@update')->name('update');


// //AJAX ROUTES...........................................................................
// Route::get('ajaxdata', 'AjaxdataController@index')->name('ajaxdata');
// Route::get('ajaxdata/getdata', 'AjaxdataController@getdata')->name('ajaxdata.getdata');

// Route::post('ajaxdata/postdata', 'AjaxdataController@postdata')->name('ajaxdata.postdata');

// Route::get('ajaxdata/fetchdata', 'AjaxdataController@fetchdata')->name('ajaxdata.fetchdata');
//THIS ROUTE FOR ADD AN ITEM IN DATABASE
 	
Route::get('/', 'IndexPaypalController@readItems');
Route::post('/addItem', 'IndexPaypalController@addItem');
Route::post('/editItem','IndexPaypalController@editItem');
Route::post('/deleteItem','IndexPaypalController@deleteItem');


Route::resource('posts','PostController');
Route::post('posts/changeStatus', array('as' => 'changeStatus', 'uses' => 'PostController@changeStatus'));

Route::get('getState','IndexPaypalController@state')->name('getState');

Route::post('getDistrict','IndexPaypalController@district')->name('getDistrict');

Route::post('getCity','IndexPaypalController@city')->name('getCity');

