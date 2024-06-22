<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardControllers;
use App\Http\Controllers\admin\auth\AdminLoginControllers;
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
Route::get('/admin/login', [AdminLoginControllers::class, 'login'])->name('admin.login');
Route::post('/admin/store-login', [AdminLoginControllers::class, 'storeLogin'])->name('admin.storeLogin');
Route::prefix('admin')->middleware(['auth'])->group(function () { 
    Route::get('/dashboard', [DashboardControllers::class, 'index']);
    Route::prefix('/category')->group(function () {
        Route::get('/', [CategoryControllers::class, 'index'])->name("category.index")->middleware('can:list_category');
        Route::get('/add', [CategoryControllers::class, 'create'])->name("category.add")->middleware('can:add_category');
        Route::post('/store', [CategoryControllers::class, 'store'])->name("category.store")->middleware('can:add_category');
        Route::get('/edit/{id}', [CategoryControllers::class, 'edit'])->name("category.edit")->middleware('can:edit_category');
        Route::post('/update/{id}', [CategoryControllers::class, 'update'])->name("category.update")->middleware('can:edit_category');
        Route::delete('/delete/{id}', [CategoryControllers::class, 'delete'])->name("category.delete")->middleware('can:delete_category');
    });
     
});

   

 