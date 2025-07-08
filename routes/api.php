<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TradeController;

Route::post('/explorers', [ExplorerController::class, 'store']);
Route::get('/explorers', [ExplorerController::class, 'index']);
Route::get('/explorers/{explorer}', [ExplorerController::class, 'show']);
Route::put('/explorers/{explorer}/edit', [ExplorerController::class, 'update']);
Route::get('/explorers/{explorer}/history', [ExplorerController::class, 'history']);

Route::post('/items', [ItemController::class, 'store']);
Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/{item}', [ItemController::class, 'show']);

Route::post('/trades', [TradeController::class, 'store']);
