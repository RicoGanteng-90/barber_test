<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLayananController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminSessionController;
use App\Http\Controllers\Admin\SessionAdminController;
use App\Http\Controllers\admin\StockController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

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

//Route untuk halaman login dan register customer
Route::get('/', [SessionController::class,'index'])->name('session.index');
Route::post('/', [SessionController::class,'store'])->name('session.store');
Route::post('/register', [SessionController::class,'create'])->name('session.create');
Route::post('/logout', [SessionController::class,'destroy'])->name('session.destroy');

Route::middleware(['customer'])->group(function () {

//Route untuk halaman home customer
Route::get('/home', [DashboardController::class,'index'])->name('home.index');

//Route untuk halaman produk customer
Route::get('/productPage', [ProductController::class,'index'])->name('product.index');

//Route untuk halaman keranjang customer
Route::get('/cart', [CartController::class,'index'])->name('cart.index');
Route::post('/cartAdd/{id}', [CartController::class,'create'])->name('cart.create');
Route::post('/layananAdd/{id}', [CartController::class,'tambahLayanan'])->name('cart.tambahLayanan');
Route::delete('/cartHapus/{id}', [CartController::class,'destroy'])->name('cart.delete');
Route::post('/cartEdit/{id}', [CartController::class,'edit'])->name('cart.edit');
Route::get('/check', [CartController::class,'check'])->name('cart.check');
Route::post('/checkout', [CartController::class,'checkout'])->name('cart.checkout');

//Route untuk halaman about customer
Route::get('/about', [AboutController::class,'index'])->name('about.index');

//Route untuk halaman order customer
Route::get('/order', [OrderController::class,'index'])->name('order.index');
Route::delete('/orderDelete/{id}', [OrderController::class,'hapusOrder'])->name('order.delete');
Route::post('/uploadBukti/{id}', [OrderController::class,'uploadBukti'])->name('order.bukti');

//Route untuk halaman layanan customer
Route::get('/service', [ServiceController::class,'index'])->name('service.index');

});



//Route untuk halaman login dan register admin
Route::get('/adminlogin', [AdminSessionController::class,'index'])->name('adminsession.index');
Route::post('/adminlogin', [AdminSessionController::class,'store'])->name('adminsession.store');
Route::get('/adminregister', [AdminSessionController::class,'register'])->name('adminsession.register');

Route::middleware(['admin'])->group(function () {

//Route untuk halaman dashboard admin
Route::get('/dashboard', [AdminDashboardController::class,'index'])->name('admindashboard.index');

//Route untuk halaman produk admin
Route::get('/adminproduct', [AdminProductController::class,'index'])->name('adminproduct.index');
Route::post('/adminproductcreate/{id}', [AdminProductController::class,'create'])->name('adminproduct.create');
Route::post('/supplierAdd/{id}', [AdminProductController::class,'tambahSupplier'])->name('supplierAdd.tambahSupplier');

//Route untuk layanan produk admin
Route::get('/adminservice', [AdminLayananController::class,'index'])->name('adminlayanan.index');
Route::post('/addService/{id}', [AdminLayananController::class,'create'])->name('addService.create');

//Route untuk halaman order admin
Route::get('/adminorder', [AdminOrderController::class,'index'])->name('adminorder.index');

//Route untuk halaman stock admin
Route::get('/adminStock', [StockController::class,'index'])->name('stock.index');
Route::post('/adminStockStore/{id}', [StockController::class,'create'])->name('stock.create');
});
