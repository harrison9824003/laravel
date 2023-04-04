<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FrontController;
use App\Http\Controllers\Member\LoginController;
use App\Http\Controllers\Member\Register;
use Illuminate\Http\Request;

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
    Route::get('/{front}', [FrontController::class, 'show'])->name('show');

    // 顯示單一類別列表
    Route::get('/category/{category}', [FrontController::class, 'category'])->name('category');    
    
});

Route::name('member.')->prefix('member')->group(function(){
    Route::post('register', Register::class)->name('memberRegister');
    Route::post('login', [LoginController::class, 'login'])->name('memberLogin');
});

// 前台選單
Route::get('/menu', [FrontController::class, 'mainMenu'])->name('menu');
