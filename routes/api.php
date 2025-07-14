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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});


Route::get('search-data-user-id-package', 'Backend\orderController@SearchDataOfUser');

Route::get('search-data-user-id-package-to-ware-houses', 'Backend\orderController@SearchWareHouse');

Route::get('search-data-order-to-date','Backend\orderController@searchDataToCodeOrder');

Route::get('history_print','Backend\orderController@history_print');

Route::get('data-order-print', 'Backend\orderController@get_info_hour_platform');

Route::get('show-product-qualtity', 'sheetApiController@showQualtity');

Route::get('show-data-order-new', 'sheetApiController@show_order_details');

Route::get('show-data-order-new-3', 'sheetApiController@show_order_details_month_3');

Route::get('get-data-order-details', 'Backend\orderController@getdata');

Route::get('search-data-order-details', 'Backend\orderController@searchDataOrder');






