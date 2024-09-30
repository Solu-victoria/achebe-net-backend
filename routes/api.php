<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//user connect wallet
Route::post('/connect-wallet', [AuthController::class, 'connectWallet']);
//user disconnect wallet
Route::post('/disconnect-wallet', [AuthController::class, 'disconnectWallet'])->middleware('auth:sanctum');