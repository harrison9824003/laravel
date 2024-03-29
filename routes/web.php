<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\FrontController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('front.index');
});

Route::group(['prefix' => 'adm', 'middleware' => ['auth', 'admin.menu']], function(){
    
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::resource('article', 'App\Http\Controllers\ArticleController');
    Route::resource('category', 'App\Http\Controllers\CategoryController');
    Route::resource('datatypefolder', 'App\Http\Controllers\DataTypeFolderController');
    Route::resource('datatype', 'App\Http\Controllers\DataTypeController')->except(['create', 'store', 'destory']);
    Route::resource('product', 'App\Http\Controllers\ProductController');
    Route::resource('permission', 'App\Http\Controllers\PermissionController');
    Route::resource('spec', 'App\Http\Controllers\SpecCategoryController');

    // API
    Route::post('/delete/spec/{id}', [App\Http\Controllers\ProductController::class, 'deleteSpec'])->name('deleteSpec');
    Route::post('/delete/img/{id}', [App\Http\Controllers\AdminController::class, 'deleteImg'])->name('deleteImg');
    Route::post('/getChildenCategory/{category}', [App\Http\Controllers\CategoryController::class, 'getChildenCategory'])->name('getChildenCategory');
    Route::post('/getChildenSpec/{spec}', [App\Http\Controllers\ProductController::class, 'getChildenSpec'])->name('getChildenSpec');

});

Route::prefix('adm')->group(function(){
    Auth::routes([ 'verify' => false ]);
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
     
        return redirect('/adm');
    })->middleware(['auth', 'signed'])->name('verification.verify');
});
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


// 加入購物車
Route::post('/cart/add', [FrontController::class, 'cart'])->name('cartAdd');