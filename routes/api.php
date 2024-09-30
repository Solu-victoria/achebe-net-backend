<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

//user connect wallet
Route::post('/connect-wallet', [AuthController::class, 'connectWallet']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    //get user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    //user disconnect wallet
    Route::post('/disconnect-wallet', [AuthController::class, 'disconnectWallet'])->middleware('auth:sanctum');
    //track user progress endpoint
    Route::post('/user/track-progress', [UserController::class, 'trackUserProgress'])->middleware('auth:sanctum');
});
