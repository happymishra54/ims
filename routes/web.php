<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\LedgerController;
use App\Models\Product;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
        return redirect('/login');
    });

Route::get('/dashboard', function () {

    $products = Product::latest()
                    ->take(5)
                    ->get();

    return view(
        'dashboard',
        compact('products')
    );

})->name('view.dashboard')->middleware('admin');

// Route::get('/', function () {
//     return view('dashboard');
// })->name('view.dashboard');

// Route::get('/customers',[CustomerController::class, 'create'])->name('customer.create');
// Route::post('/customer',[CustomerController::class, 'store'])->name('customer.store');
// Route::get('/customer',[CustomerController::class, 'index'])->name('customer.index');
// the bove three routes can be replaced by the below line of code as it will automatically create all the necessary routes for the customer resource
Route::resource('customer', CustomerController::class);
Route::resource('product', ProductController::class);
Route::post('/product/{id}/margin', [ProductController::class, 'updateMargin'])->name('product.updateMargin');
Route::get('/product/search', [ProductController::class, 'search'])->name('product.search');
Route::resource('supplier', SupplierController::class);
Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show');
Route::resource('ledger', LedgerController::class);
Route::get('/login', [LoginController::class,'showLogin'])
        ->name('login');

Route::post('/login', [LoginController::class,'login']);

Route::get('/signup', [LoginController::class,'showSignup'])
        ->name('signup');

Route::post('/signup', [LoginController::class,'signup']);

Route::post('/logout', [LoginController::class,'logout'])
        ->name('logout');


// adding this temporary for render

use Illuminate\Support\Facades\Artisan;

Route::get('/migrate', function () {
    Artisan::call('migrate', ['--force' => true]);

    return 'Migration completed';
});



Route::get('/migrate', function () {
    Artisan::call('migrate', ['--force' => true]);

    return Artisan::output();
});