<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MerchandiseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [MerchandiseController::class, 'merchandiseListPage']);

Route::group(['prefix' => 'user'], function(){

    Route::group(['prefix' => 'auth'], function(){

        Route::get('/sign-up', [MemberController::class, 'signUpPage']);

        Route::post('/sign-up', [MemberController::class, 'signUpProcess']);

        Route::get('/sign-in', [MemberController::class, 'signInPage']);
        Route::post('/sign-in', [MemberController::class, 'signInProcess']);
        Route::get('/sign-out', [MemberController::class, 'signOut']);
        
    });
});

Route::group(['prefix' => 'merchandise'], function(){

    Route::get('/', [MerchandiseController::class, 'merchandiseListPage']);

    Route::get('/create', [MerchandiseController::class, 'merchandiseCreateProcess'])->middleware(['user.auth.admin']);

    Route::get('/manage', [MerchandiseController::class, 'merchandiseManageListPage'])->middleware(['user.auth.admin']);

    // 商品內容
    Route::group(['prefix' => '{merchandise_id}'], function(){

        // 商品頁面
        Route::get('/', [MerchandiseController::class, 'merchandiseItemPage']);        

        // 購品商品頁
        Route::post('/buy', [MerchandiseController::class, 'merchandiseItemBuyProcess'])->middleware(['user.auth']);

        Route::group(['middleware' => ['user.auth.admin']], function (){
            // 商品編輯頁面
            Route::get('/edit', [MerchandiseController::class, 'merchandiseItemEditPage']);

            // 商品資料修改
            Route::put('/', [MerchandiseController::class, 'merchandiseItemUpdateProcess']);
        });
        
        
    });

});

Route::get('/transaction', [TransactionController::class, 'transactionListPage'])->middleware(['user.auth']);
