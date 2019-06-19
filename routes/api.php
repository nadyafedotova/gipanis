<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Reports\Simple\TablesListController;
use App\Http\Controllers\Api\Reports\Simple\AmzRatingController;
use App\Http\Controllers\Api\Reports\Complex\AmazonCalculatorController;
use App\Http\Controllers\Api\Reports\Complex\AmazonImportController;
use App\Http\Controllers\Api\DataTable\FilterSettingsController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\Reports\Complex\AmzBuyerInfoController;
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
Route::group([
    'middleware' => ['throttle:60,1'],
], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::get('/stores', [StoreController::class, 'getList']);
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'namespace' => 'Api',
    'middleware' => ['auth:api'],
], function () {
    Route::get('/amz/table/{code}', [TablesListController::class, 'index'])->where(['code' => '[a-z,A-Z,\d]{3}']);
    Route::get('/jtl/table/{code}', [TablesListController::class, 'index'])->where(['code' => '[a-z,A-Z,\d]{3}']);
    Route::get('/amz/rating', [AmzRatingController::class, 'index']);


    // Get Fields for reports
    Route::get('/amz/table/{code}/fields', [TablesListController::class, 'getFields'])->where(['code' => '[a-z,A-Z,\d]{3}']);
    Route::get('/jtl/table/{code}/fields', [TablesListController::class, 'getFields'])->where(['code' => '[a-z,A-Z,\d]{3}']);
    Route::get('/amz/rating/fields', [AmzRatingController::class, 'getFields']);

    // Get Filters for reports
    Route::get('/filters/{code}', 'DataTable\FilterSettingsController');


    //Amazon Import
    Route::get('/amz/import', [AmazonImportController::class, 'index']);
    Route::get('/amz/import/download-products', [AmazonImportController::class, 'downloadProducts']);
    Route::get('/amz/import/template-file', [AmazonImportController::class, 'getTemplateFileInfo']);
    Route::post('/amz/import/store-template', [AmazonImportController::class, 'storeTemplate']);


    //Amazon Calculator
    Route::get('/amz/calculator', [AmazonCalculatorController::class, 'index']);
    Route::get('/amz/calculator/excel', [AmazonCalculatorController::class, 'excel']);


    // Amazon Buyer
    Route::get('amz/buyerinfo', [AmzBuyerInfoController::class, 'index']);

});