<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::put('/explorers/{explorer}/edit', [ExplorerController::class, 'update']);
    Route::get('/explorers', [ExplorerController::class, 'index']);
    Route::get('/explorers/{explorer}', [ExplorerController::class, 'show']);
    Route::get('/explorers/{explorer}/history', [ExplorerController::class, 'history']);

    Route::post('/items', [ItemController::class, 'store']);
    Route::get('/items/{item}', [ItemController::class, 'show']);
});

Route::post('/trades', [TradeController::class, 'store']);
Route::get('/items', [ItemController::class, 'index']);
