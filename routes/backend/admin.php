<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Reports\Simple\TablesListController;
use App\Http\Controllers\Backend\Reports\Simple\AmzRatingController;
use App\Http\Controllers\Backend\Reports\Complex\AmazonImportController;
use App\Http\Controllers\Backend\Reports\Complex\AmazonCalculatorController;
use App\Http\Controllers\Backend\Reports\Complex\AmzBuyerInfoController;
/*
 * All route names are prefixed with 'admin.'.
 */
//Route::redirect('/', '/admin/dashboard', 301);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/amz/table/{code}', [TablesListController::class, 'index'])->name('amz.table-list')->where(['code' => '[a-z,A-Z,\d]{3}']);
Route::get('/jtl/table/{code}', [TablesListController::class, 'index'])->name('jtl.table-list')->where(['code' => '[a-z,A-Z,\d]{3}']);
Route::group([
    'prefix' => 'reports/complex'
], function() {

    Route::get('/amz/rating', [AmzRatingController::class, 'index'])->name('amz.rating');
    Route::get('/amz/import', [AmazonImportController::class, 'index'])->name('amz.import');
    Route::get('/amz/calculator', [AmazonCalculatorController::class, 'index'])->name('amz.calculator');

});

Route::get('/amz/rating', [AmzRatingController::class, 'index'])->name('amz.rating');
Route::get('/amz/import', [AmazonImportController::class, 'index'])->name('amz.import');
Route::get('amz/buyerinfo', [AmzBuyerInfoController::class, 'index'])->name('amz.buyerinfo');
