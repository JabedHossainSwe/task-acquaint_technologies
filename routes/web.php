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
use App\Models\Order;
use App\Models\Product;
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
Route::get('/admin/dashboard', function () {
  if (Auth::check() && Auth::user()->id === 1) {
    // Fetch data
    $totalOrders = Order::whereMonth('created_at', now()->month)->count();
    $totalSales = Order::whereMonth('created_at', now()->month)->sum('total_amount'); // Use 'total_amount'
    $topProducts = Product::withCount('orders')
      ->orderBy('orders_count', 'desc')
      ->take(5)
      ->get();

    return view('admin.dashboard', compact('totalOrders', 'totalSales', 'topProducts'));
  }

  return redirect('/');
})->name('admin.dashboard');


// Category Routes
Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/admin/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/admin/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
Route::get('/admin/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('/admin/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('/admin/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

// Product Routes
Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products.index');
Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

// Order Routes
Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
Route::get('/admin/orders/show', [AdminOrderController::class, 'show'])->name('admin.orders.show');
Route::get('/admin/orders/create', [AdminOrderController::class, 'create'])->name('admin.orders.create');
Route::post('/admin/orders', [AdminOrderController::class, 'store'])->name('admin.orders.store');
Route::get('/admin/orders/{order}/edit', [AdminOrderController::class, 'edit'])->name('admin.orders.edit');
Route::put('/admin/orders/{order}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
Route::delete('/admin/orders/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');
Route::get('/admin/orders/{order}/invoice', [AdminOrderController::class, 'generateInvoice'])->name('order.invoice');

// Customer Routes
Route::get('/admin/customers', [AdminCustomerController::class, 'index'])->name('admin.customers.index');
Route::get('/admin/customers/create', [AdminCustomerController::class, 'create'])->name('admin.customers.create');
Route::post('/admin/customers', [AdminCustomerController::class, 'store'])->name('admin.customers.store');
Route::get('/admin/customers/{customer}/edit', [AdminCustomerController::class, 'edit'])->name('admin.customers.edit');
Route::put('/admin/customers/{customer}', [AdminCustomerController::class, 'update'])->name('admin.customers.update');
Route::delete('/admin/customers/{customer}', [AdminCustomerController::class, 'destroy'])->name('admin.customers.destroy');

// Route for generating an invoice
Route::get('admin/orders/{order}/invoice', [AdminOrderController::class, 'generateInvoice'])->name('orders.invoice');

// Route for generating order reports
Route::get('admin/reports/orders', [ReportController::class, 'orderReport'])->name('report.orders');

// Route for generating customer reports
Route::get('admin/reports/customers', [ReportController::class, 'customerReport'])->name('report.customers');
// web.php
Route::get('/admin/reports/orders/download', [ReportController::class, 'downloadOrderReport'])->name('report.orders.download');
Route::get('/admin/reports/customers/download', [ReportController::class, 'downloadCustomerReport'])->name('report.customers.download');
Route::get('/admin/reports/customers/pdf', [ReportController::class, 'customerReportPDF'])->name('report.customers.pdf');
