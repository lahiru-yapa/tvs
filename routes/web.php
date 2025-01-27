<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RefController;


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

    Route::middleware(['ref'])->group(function () {
        // Routes that require the 'ref' role
        Route::get('/ref-invoices', [RefController::class, 'index'])->name('refinvoice.index');
        Route::post('/ref-invoices/action', [RefController::class, 'handleAction'])->name('invoices.ref.action');
        Route::get('/ref-invoices/{id}/edit', [RefController::class, 'edit'])->name('invoices.ref.edit');
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
        Route::get('/shops/credit-limit', [ShopesController::class, 'getShopCreditLimit'])->name('shops.creditLimit');
        Route::get('/get-average-days', [ShopesController::class, 'getAverageDays']);

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

        Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::get('/products/suggest', [InvoiceController::class, 'suggestProducts'])->name('products.suggest');
        Route::get('/products/details', [InvoiceController::class, 'getProductDetails'])->name('products.details');
        Route::post('/product/store', [InvoiceController::class, 'store'])->name('invoice.store');
        Route::get('/add-invoice', [InvoiceController::class, 'addinvoice'])->name('addinvoice');
        Route::post('/invoice/store', [InvoiceController::class, 'storeInvoice'])->name('invoice.storeInvoice');
        Route::post('/invoices/action', [InvoiceController::class, 'handleAction'])->name('invoices.action');
        Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoices.show');
        Route::get('/invoices/{id}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
        // In routes/web.php
        Route::post('/update-invoice-description', [InvoiceController::class, 'updateDescription']);

    });
    
});

 
Route::get('/', function () {
    return redirect('/login');
});