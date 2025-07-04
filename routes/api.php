<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExplorerController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/explorers', [ExplorerController::class, 'index']);
Route::post('/explorers', [ExplorerController::class, 'store']);
Route::get('/explorers/{explorer}', [ExplorerController::class, 'show']);
Route::put('/explorers/{explorer}/edit', [ExplorerController::class, 'update']);
