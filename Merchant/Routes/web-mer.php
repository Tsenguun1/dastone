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

Route::prefix('merchant')->group(function() {
    Route::get('/', 'MerchantController@index');
});


Route::group(array('prefix' => 'merchant', 'before' => 'auth'), function() {
    Route::get('/', ['middleware' => 'auth', 'uses' => 'MerchantController@showMerchantList'])->name('publicshowMerchantList');
    Route::get('/get/merchTable', ['middleware' => 'auth', 'uses' => 'MerchantController@merchantListTable'])->name('publicmerchantListTable');
    Route::post('/get/addMerchModal', ['middleware' => 'auth', 'uses' => 'MerchantController@getAddMerchModal'])->name('publicgetAddMerchModal');
    Route::post('/get/editMerchModal', ['middleware' => 'auth', 'uses' => 'MerchantController@getEditMerchModal'])->name('publicgetEditMerchModal');
    Route::post('/check/merchID', ['middleware' => 'auth', 'uses' => 'MerchantController@checkMerchID'])->name('publiccheckMerchID');
    Route::post('/register/post', ['middleware' => 'auth', 'uses' => 'MerchantController@registerMerch'])->name('publicregisterMerch');
    Route::post('/edit/post', ['middleware' => 'auth', 'uses' => 'MerchantController@editMerch'])->name('publiceditMerch');
    Route::post('/get/detailMerchModal', ['middleware' => 'auth', 'uses' => 'MerchantController@getDetailMerchModal'])->name('publicgetDetailMerchModal');
    Route::post('/get/deleteMerchModal', ['middleware' => 'auth', 'uses' => 'MerchantController@getDeleteMerchModal'])->name('publicgetDeleteMerchModal');
    Route::post('/deleteMerch/post', ['middleware' => 'auth', 'uses' => 'MerchantController@deleteMerch'])->name('publicdeleteMerch');
    Route::post('/get/custCaAcnt', ['middleware' => 'auth', 'uses' => 'MerchantController@getCustCaAcnt'])->name('publicgetCustCaAcnt');
});
