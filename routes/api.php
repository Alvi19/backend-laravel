<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DbeliController;
use App\Http\Controllers\HbeliController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SuplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/pembelian', [HbeliController::class, 'create']);

Route::apiResources([
    'barang' => BarangController::class,
    'suplier' => SuplierController::class,
    'pembeli' => HbeliController::class,
    'detail-pembelian' => DbeliController::class,
    'stock' => StockController::class,
    'hutang' => HutangController::class
]);
