<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::name('front.')->prefix('front')->group(function(){   

    // 顯示單一筆資料
    Route::get('/{front}', [\App\Http\Controllers\Api\FrontController::class, 'show'])->name('show');

    // 顯示單一類別列表
    Route::get('/category/{category}', [\App\Http\Controllers\Api\FrontController::class, 'category'])->name('category');

    
});

// 前台選單
Route::get('/menu', [\App\Http\Controllers\Api\FrontController::class, 'mainMenu'])->name('menu');

