<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

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
    return view('welcome');
});

Route::group(['prefix' => 'adm'], function(){
    
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::resource('product', 'App\Http\Controllers\ProductController');
    Route::resource('article', 'App\Http\Controllers\ArticleController');

});