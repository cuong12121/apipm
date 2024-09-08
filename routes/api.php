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

Route::get('search-data-order-to-date','Backend\orderController@SearchDataOfOrder')


Route::get('show-product-qualtity', 'sheetApiController@showQualtity');

Route::get('get-data-order-details', 'Backend\orderController@getdata');

Route::get('search-data-order-details', 'Backend\orderController@searchDataOrder');





