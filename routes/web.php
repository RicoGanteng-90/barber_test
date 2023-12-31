<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminBarangJual;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLayananController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminSessionController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PenjualanController;
use App\Http\Controllers\admin\StockController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
Route::post('/customer/logout', [SessionController::class,'destroy'])->name('session.destroy');

Route::middleware(['customer'])->group(function () {

    //Route untuk halaman home customer
    Route::get('/home', [DashboardController::class,'index'])->name('home.index');

    //Route untuk halaman profile customer
    Route::get('/profile', [ProfileController::class,'index'])->name('profile.index');
    Route::post('/profile-update', [ProfileController::class,'update'])->name('profile.update');
    Route::post('/profile-edit', [ProfileController::class,'edit'])->name('profile.edit');

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

    //Route untuk halaman pdf
    Route::get('/note/{id}', [NoteController::class,'index'])->name('note.index');
    Route::get('/cetakNota/{id}', [NoteController::class,'cetak_pdf'])->name('note.cetak_pdf');
    });


//Route untuk halaman login dan register admin
Route::get('/adminlogin', [AdminSessionController::class,'index'])->name('adminsession.index');
Route::post('/adminlogin', [AdminSessionController::class,'store'])->name('adminsession.store');
Route::post('/adminregister', [AdminSessionController::class,'register'])->name('adminsession.register');
Route::post('/owner/logout', [AdminSessionController::class,'destroy'])->name('adminsession.destroy');

Route::middleware(['role'])->group(function () {

    //Route untuk halaman dashboard admin
    Route::get('/dashboard', [AdminDashboardController::class,'index'])->name('admindashboard.index');
    Route::post('/fetch-chart-data', [AdminDashboardController::class, 'fetchData'])->name('chart.fetchData');
    Route::post('/fetch-chart-data2', [AdminDashboardController::class, 'fetchData2'])->name('chart.fetchData2');
    Route::post('/fetch-chart-data3', [AdminDashboardController::class, 'fetchData3'])->name('chart.fetchData3');
    Route::post('/fetch-chart-data4', [AdminDashboardController::class, 'fetchData4'])->name('chart.fetchData4');
    Route::post('/fetch-chart-data5', [AdminDashboardController::class, 'fetchData5'])->name('chart.fetchData5');


    //Route untuk halaman produk admin
    Route::get('/adminproduct', [AdminProductController::class,'index'])->name('adminproduct.index');
    Route::post('/notaBeli', [AdminProductController::class,'tambahBarang'])->name('nota.tambahBarang');
    Route::delete('/notaHapus/{id}', [AdminProductController::class,'destroy'])->name('nota.destroy');
    Route::post('/notaEdit/{id}', [AdminProductController::class,'update'])->name('nota.update');
    Route::get('/adminlayanan', [AdminProductController::class,'show'])->name('adminproduct.show');
    Route::post('/adminproductcreate/{id}', [AdminProductController::class,'create'])->name('adminproduct.create');
    Route::post('/supplierAdd/{id}', [AdminProductController::class,'tambahSupplier'])->name('supplierAdd.tambahSupplier');
    Route::post('/customerAdd/{id}', [AdminProductController::class,'tambahCustomer'])->name('customerAdd.tambahCustomer');

    //Route untuk layanan produk admin
    Route::get('/adminservice', [AdminLayananController::class,'index'])->name('adminlayanan.index');
    Route::post('/adminserviceUpdate/{id}', [AdminLayananController::class,'update'])->name('adminlayanan.update');
    Route::delete('/adminserviceDelete/{id}', [AdminLayananController::class,'destroy'])->name('adminlayanan.destroy');
    Route::post('/addService/{id}', [AdminLayananController::class,'create'])->name('addService.create');
    Route::post('/addUser/{id}', [AdminLayananController::class,'tambahUser'])->name('addService.tambahUser');

    //Route untuk penjualan produk admin
    Route::get('/barang2', [AdminBarangJual::class,'index'])->name('barang2.index');
    Route::post('/barangUpdate2/{id}', [AdminBarangJual::class,'update'])->name('barang2.update');
    Route::delete('/barangDelete2/{id}', [AdminBarangJual::class,'destroy'])->name('barang2.destroy');
    Route::post('/barangAdd/{id}', [AdminBarangJual::class,'create'])->name('barang2.create');
    Route::post('/customerAdd/{id}', [AdminBarangJual::class,'store'])->name('barang2.store');

    Route::post('/jualBarang', [PenjualanController::class,'jualBarang'])->name('jual.barang');

    //Route untuk halaman order admin
    Route::get('/adminorder', [AdminOrderController::class,'index'])->name('adminorder.index');

    //Route untuk halaman stock admin
    Route::get('/adminStock', [StockController::class,'index'])->name('stock.index');
    Route::post('/adminStockStore/{id}', [StockController::class,'create'])->name('stock.create');

    Route::get('/showNote', [NoteController::class,'show'])->name('note.show');
    Route::get('/beliBarang', [NoteController::class,'beliBarang'])->name('note.beliBarang');

    Route::get('/jualShow', [NoteController::class,'tampilNotaBarang'])->name('jual.show');
    Route::get('/jualProduct', [NoteController::class,'notaJual'])->name('note.jualBarang');

    Route::get('/jualLayan', [NoteController::class,'tampilNotaLayanan'])->name('jual.layan');
    Route::get('/jualLayanan', [NoteController::class,'notaLayan'])->name('note.jualLayanan');

    Route::post('/jualLayanan', [AdminServiceController::class,'jualLayanan'])->name('layanan2.jualLayanan');

    Route::post('/order-update/{id}', [AdminOrderController::class,'update'])->name('order.update');
    Route::delete('/order-delete/{id}', [AdminOrderController::class,'destroy'])->name('order.destroy');

    Route::get('/download-image/{order_img}', [AdminOrderController::class, 'download'])->name('image.download');

    Route::post('/update-barang/{id}', [StockController::class, 'update'])->name('barang3.update');
    Route::delete('/hapus-barang/{id}', [StockController::class, 'destroy'])->name('barang3.destroy');

    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/supplier2', [SupplierController::class, 'supplier'])->name('supplier.supplier');
    Route::get('/supplierKembali/{id}', [SupplierController::class, 'kembalikan'])->name('supplier.kembalikan');
    Route::get('/supplierKembali2', [SupplierController::class, 'kembalikan2'])->name('supplier.kembalikan2');
    Route::get('/supplierHapus/{id}', [SupplierController::class, 'hapus_permanen'])->name('supplier.hapus');
    Route::get('/supplierHapus2', [SupplierController::class, 'hapus_permanen2'])->name('supplier.hapus2');
    Route::post('/addSupplier', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/updateSupplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/deleteSupplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang3', [BarangController::class, 'barang'])->name('barang.barang');
    Route::get('/barangKembali/{id}', [BarangController::class, 'kembalikan'])->name('barang.kembalikan');
    Route::get('/barangKembali2', [BarangController::class, 'kembalikan2'])->name('barang.kembalikan2');
    Route::get('/barangHapus/{id}', [BarangController::class, 'hapus_permanen'])->name('barang.hapus');
    Route::get('/barangHapus2', [BarangController::class, 'hapus_permanen2'])->name('barang.hapus2');
    Route::post('/addBarang', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/updateBarang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/deleteBarang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    Route::get('/layanan2', [LayananController::class, 'index'])->name('layanan.index');
    Route::post('/addLayanan', [LayananController::class, 'create'])->name('layanan.create');
    Route::post('/updateLayanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
    Route::delete('/deleteLayanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');
    Route::get('/layanan3', [LayananController::class, 'layanan3'])->name('layanan.layanan');
    Route::get('/layananKembali/{id}', [LayananController::class, 'kembalikan'])->name('layanan.kembalikan');
    Route::get('/layananKembali2', [LayananController::class, 'kembalikan2'])->name('layanan.kembalikan2');
    Route::get('/layananHapus/{id}', [LayananController::class, 'hapus_permanen'])->name('layanan.hapus');
    Route::get('/layananHapus2', [LayananController::class, 'hapus_permanen2'])->name('layanan.hapus2');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/addUser', [UserController::class, 'create'])->name('user.create');
    Route::post('/updateUser/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/deleteUser/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user2', [UserController::class, 'user2'])->name('user.user');
    Route::get('/userKembali/{id}', [UserController::class, 'kembalikan'])->name('user.kembalikan');
    Route::get('/userKembali2', [UserController::class, 'kembalikan2'])->name('user.kembalikan2');
    Route::get('/userHapus/{id}', [UserController::class, 'hapus_permanen'])->name('user.hapus');
    Route::get('/userHapus2', [UserController::class, 'hapus_permanen2'])->name('user.hapus2');
    });

    Route::get('/filterByDate', [AdminProductController::class,'filterByDate'])->name('nota.filter1')->middleware('owner');
    Route::get('/filterByDate2', [AdminProductController::class,'filterByDate2'])->name('nota.filter2')->middleware('owner');
    Route::get('/filterByDate3', [AdminServiceController::class,'filterByDate3'])->name('nota.filter3')->middleware('owner');
