<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
// Route::get('/login', function () {
//   if (Auth::check()) {
//     if (Auth::user()->id === 1) {
//       return redirect()->route('admin.dashboard');
//     } else {
//       return redirect('/');
//     }
//   }

//   return view('auth.login');
// });
Route::get('/', [HomeController::class, 'index'])->name(name: 'index');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');


// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products.index');

// Cart Routes
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// Order Route
Route::post('/order', [OrderController::class, 'place'])->name('order.place');

// Order confirmation route
Route::get('/order/confirmation', [OrderController::class, 'confirmation'])->name('order.confirmation');

// Admin Routes
// routes/web.php

Route::middleware(['auth', 'admin'])->group(function () {
  // Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
  Route::get('/admin/dashboard', function () {
    if (Auth::user()->id !== 1) {
      return redirect('/');
    }
    return view('admin.dashboard');
  })->name('admin.dashboard');
  Route::resource('admin/categories', AdminCategoryController::class);
  // Route::resource('admin/products', AdminProductController::class);
  Route::resource('admin/orders', AdminOrderController::class);
  Route::resource('admin/customers', AdminCustomerController::class);
  Route::get('admin/orders/{order}/invoice', [AdminOrderController::class, 'generateInvoice'])->name('order.invoice');
  Route::get('admin/reports/orders', [ReportController::class, 'orderReport'])->name('report.orders');
  Route::get('admin/reports/customers', [ReportController::class, 'customerReport'])->name('report.customers');
});
