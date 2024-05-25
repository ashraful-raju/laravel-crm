<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('customers', CustomerController::class);

    Route::resource('products', ProductController::class);

    Route::resource('invoices', InvoiceController::class);
    Route::get('/invoices/create/products', [InvoiceController::class, 'getAddProductForm'])->name('invoices.create.product');
});

// Route::any('test', function () {
//     dd(
//         \App\Models\Invoice::with(['products', 'customer', 'user'])
//             ->first()
//     );
// });

require __DIR__ . '/auth.php';
