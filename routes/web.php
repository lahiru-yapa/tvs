<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('auth.login'); // Ensure this matches your login view
})->name('login');


Route::middleware(['auth'])->group(function () {
    Route::get('/index', function () {
        return view('welcome'); // Replace 'index' with your actual view name
    });

    Route::middleware(['admin'])->group(function () {
        Route::get('/all-user', [UserController::class, 'allUsers'])->name('alluser');
        Route::get('/add-user', [UserController::class, 'adduser'])->name('adduser');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/edit', [UserController::class, 'editUseSstore'])->name('user.editStore');
        Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');

        
        Route::get('/all-shopes', [ShopesController::class, 'allshopes'])->name('allshopes');
        Route::get('/add-shopes', [ShopesController::class, 'addshopes'])->name('addshopes');
        Route::post('/shops', [ShopesController::class, 'store'])->name('shops.store');
        Route::get('shops/{id}/edit', [ShopesController::class, 'edit'])->name('shops.edit');
        Route::post('/shop/edit', [ShopesController::class, 'editShopstore'])->name('shop.editStore');
        Route::get('/shop/delete/{id}', [ShopesController::class, 'delete'])->name('shop.delete');

        Route::get('/all-suppliers', [SupplierController::class, 'allsuppliers'])->name('allsuppliers');
        Route::get('/add-suppliers', [SupplierController::class, 'addsuppliers'])->name('addsuppliers');
        Route::post('suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
        Route::get('suppliers/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
        Route::post('/suppliers/edit', [SupplierController::class, 'editSuppliers'])->name('suppliers.editStore');
        Route::get('/suppliers/delete/{id}', [SupplierController::class, 'delete'])->name('suppliers.delete');
        Route::get('suppliers/{id}/view', [SupplierController::class, 'view'])->name('suppliers.view');


        Route::get('/all-product', [ProductController::class, 'allproducts'])->name('allproduct');
        Route::get('/add-product', [ProductController::class, 'addproduct'])->name('addproduct');
        Route::post('product', [ProductController::class, 'store'])->name('product.store');
        Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/product/edit', [ProductController::class, 'editproduct'])->name('product.editProduct');
        Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        Route::get('product/{id}/view', [ProductController::class, 'view'])->name('product.view');
    });
    
});
 
Route::get('/', function () {
    return redirect('/login');
});