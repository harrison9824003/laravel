<?php

use Illuminate\Support\Facades\Route;
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

Route::group(['prefix' => 'adm', 'middleware' => ['admin.menu']], function(){
    
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::resource('product', 'App\Http\Controllers\ProductController');
    Route::resource('article', 'App\Http\Controllers\ArticleController');
    Route::resource('spec', 'App\Http\Controllers\SpecCategoryController');
    Route::resource('category', 'App\Http\Controllers\CategoryController');
    Route::resource('datatypefolder', 'App\Http\Controllers\DataTypeFolderController');
    Route::resource('datatype', 'App\Http\Controllers\DataTypeController')->except(['create', 'store', 'destory']);

    // API
    Route::post('/get_childen_category/{category}', [App\Http\Controllers\CategoryController::class, 'get_childen_category'])->name('get_childen_category');

});