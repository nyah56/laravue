<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\SupplierController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/audits', [AuditController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/trashed', [ProductController::class, 'trashed']);
    Route::get('/products/restore/{id}', [ProductController::class, 'restore']);

    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::get('/suppliers/trashed/', [SupplierController::class, 'trashed']);
    Route::get('/suppliers/{id}', [SupplierController::class, 'show']);
    Route::get('/suppliers/restore/{id}', [SupplierController::class, 'restore']);
    Route::post('/suppliers', [SupplierController::class, 'store']);
    Route::put('/suppliers/{id}', [SupplierController::class, 'update']);
    Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy']);

    Route::get('/stocks', [StockController::class, 'index']);
    Route::get('/stocks/trashed', [StockController::class, 'trashed']);
    Route::get('/stocks/restore/{id}', [StockController::class, 'restore']);
    Route::post('/stocks', [StockController::class, 'store']);
    Route::get('/stocks/{id}', [StockController::class, 'show']);
    Route::put('/stocks/{id}', [StockController::class, 'update']);
    Route::delete('/stocks/{id}', [StockController::class, 'destroy']);

    Route::get('/stock-movement', [StockMovementController::class, 'index']);
    Route::post('/stock-movement', [StockMovementController::class, 'store']);
    Route::get('/stock-movement/{id}', [StockMovementController::class, 'show']);
    Route::put('/stock-movement/{id}', [StockMovementController::class, 'update']);
    Route::delete('/stock-movement/{id}', [StockMovementController::class, 'destroy']);

    Route::get('/role', [RoleController::class, 'index']);
    Route::post('/role', [RoleController::class, 'store']);
    Route::get('/role/{id}', [RoleController::class, 'show']);
    Route::put('/role/{id}', [RoleController::class, 'update']);
    Route::delete('/role/{id}', [RoleController::class, 'destroy']);
});

Route::get('/user', function (Request $request) {

    return UserResource::make($request->user());
})->middleware('auth:sanctum');
Route::get('/usera', function (Request $request) {
    return json_encode(\Illuminate\Support\Facades\Auth::user());
})->middleware('auth:sanctum');
