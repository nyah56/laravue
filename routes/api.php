<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/audits', [AuditController::class, 'index']);
Route::middleware('auth:api')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    Route::get('/supplier', [SupplierController::class, 'index']);
    Route::post('/supplier', [SupplierController::class, 'store']);
    Route::get('/supplier/{id}', [SupplierController::class, 'show']);
    Route::put('/supplier/{id}', [SupplierController::class, 'update']);
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy']);

    Route::get('/stock', [StockController::class, 'index']);
    Route::post('/stock', [StockController::class, 'store']);
    Route::get('/stock/{id}', [StockController::class, 'show']);
    Route::put('/stock/{id}', [StockController::class, 'update']);
    Route::delete('/stock/{id}', [StockController::class, 'destroy']);

    Route::get('/stock-movement', [StockMovementController::class, 'index']);
    Route::post('/stock-movement', [StockMovementController::class, 'store']);
    Route::get('/stock-movement/{id}', [StockMovementController::class, 'show']);
    Route::put('/stock-movement/{id}', [StockMovementController::class, 'update']);
    Route::delete('/stock-movement/{id}', [StockMovementController::class, 'destroy']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
