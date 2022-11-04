<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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

    Route::resource('product', 'App\Http\Controllers\ProductController');
    Route::resource('article', 'App\Http\Controllers\ArticleController');
    Route::resource('spec', 'App\Http\Controllers\SpecCategoryController');
    Route::resource('category', 'App\Http\Controllers\CategoryController');
    Route::resource('datatypefolder', 'App\Http\Controllers\DataTypeFolderController');
    Route::resource('datatype', 'App\Http\Controllers\DataTypeController')->except(['create', 'store', 'destory']);

    // API
    Route::post('/get_childen_category/{category}', [App\Http\Controllers\CategoryController::class, 'get_childen_category'])->name('get_childen_category');
    Route::post('/get_childen_spec/{spec}', [App\Http\Controllers\ProductController::class, 'get_childen_spec'])->name('get_childen_spec');
    Route::post('/delete/spec/{id}', [App\Http\Controllers\ProductController::class, 'delete_spec'])->name('delete_spec');
    Route::post('/delete/img/{id}', [App\Http\Controllers\AdminController::class, 'delete_img'])->name('delete_img');

});

Auth::routes([ 'verify' => true ]);
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');