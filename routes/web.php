<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPhotoController;
use Illuminate\Support\Facades\Route;
//use Auth;
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

Auth::routes();


Route::get('/', function () {
    return view('welcome');
});
Route::get('/categories',[CategoryController::class,'index'])
->name('categories');

Route::get('category/search',
    [CategoryController::class,'search'])
    ->name('category.search');

Route::get('/category/create',[CategoryController::class,'create'])
    ->name('category_create');

    Route::post('/category/store',[CategoryController::class,'store'])
     ->name('category_save');

Route::get('/category/{id}/edit',[CategoryController::class,'edit'])
->name('category_edit');

Route::post('/category/{id}/update',
    [CategoryController::class,'update'])
    ->name('category_update');

Route::get('/category/{id}/delete',
    [CategoryController::class,'delete'])
    ->name('category_delete');

Route::get('/category/{id}/show_products',[CategoryController::class,'show_products'])
    ->name('category_show_products');

Route::get('/category/{id}/show',[CategoryController::class,'show'])
        ->name('category_show');

//products
Route::get('/products',[ProductController::class,'index']);
Route::resource('products',ProductController::class)
        ->only(['index','store','create','show','edit']);
Route::post('/products/{product}/update',[ProductController::class,'update'])
        ->name('products.update');
Route::post('/products/{product}/delete',[ProductController::class,'delete'])
        ->name('products.delete');

Route::GET('/products/{product}/show_category',[ProductController::class,'show_category'])
        ->name('products.show_category');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('profile',ProfileController::class)
            ->only(['show','create'
                   ,'store','edit']);
Route::post('/user/{email}/profile/{id}',[ProfileController::class,'update'])
        ->name('profile.update');

Route::post('/profile/upload/image',[UserPhotoController::class,'upload'])
        ->name('image.upload');

Route::get('/photos',[UserPhotoController::class, 'index'])
                ->name('photos.index');