<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopesController;


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

    Route::get('/all-user', [UserController::class, 'allUsers'])->name('alluser');

    Route::get('/add-user', [UserController::class, 'adduser'])->name('adduser');

    Route::get('/all-shopes', [ShopesController::class, 'allshopes'])->name('allshopes');

    Route::get('/add-shopes', [ShopesController::class, 'addshopes'])->name('addshopes');
    Route::post('/shops', [ShopesController::class, 'store'])->name('shops.store');
});



Route::get('/', function () {
    return redirect('/login');
});