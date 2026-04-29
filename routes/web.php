<?php

use App\Http\Controllers\Auth\LoginPageController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\Admin\ProductAdminController;
use Illuminate\Support\Facades\Route;

// Публичные Inertia-страницы
Route::get('/', [ProductPageController::class, 'index'])->name('home');
Route::get('/product/{product}', [ProductPageController::class, 'show'])->name('product.show');

// Страница входа
Route::get('/login', [LoginPageController::class, 'show'])->name('login');

// Защищённые админ-страницы (токен проверяется в InertiaMiddleware)
Route::middleware(['auth:sanctum'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [ProductAdminController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductAdminController::class, 'create'])->name('products.create');
    Route::get('/products/{id}/edit', [ProductAdminController::class, 'edit'])->name('products.edit');
});