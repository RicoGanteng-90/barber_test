<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Items;
use App\Models\Jual_barang;
use App\Models\Nota_barang;
use Illuminate\Http\Request;
use App\Models\Kelola_barang;
use App\Models\Stok_supplier;
use App\Models\Kelola_layanan;
use App\Models\Kelola_supplier;
use App\Models\Kelola_pembelian;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Kelola_pembelian::all();

        $supplier = Kelola_supplier::all();

        $barangSup = Stok_supplier::all();

        $customer = User::all();

        $barang = Kelola_barang::all();

        return view('admin.product.product', compact('items', 'supplier', 'barangSup', 'customer', 'barang'));
    }


    public function tambahSupplier(Request $request, $id)
    {
        $items2 = Kelola_pembelian::all();

        foreach($items2 as $items2)
        {
            $supplier = Kelola_supplier::findOrFail($id);
            if($supplier)
            {
                $items2->supplier = $supplier->nama_supplier;
                $items2->save();
            }
        }
        return back()->with('success', 'Supplier berhasil ditambahkan');
    }

    public function tambahBarang(){
        $kelola_pembelian = Kelola_pembelian::all();

        if($kelola_pembelian->isEmpty()) {
            return back()->with('error', 'Tidak ada barang untuk diproses');
        }

        $totalPrice = 0;
        $total = 0;
        $productNames = [];

        foreach ($kelola_pembelian as $item) {

            if (empty($item->supplier)) {
                return back()->with('error', 'Silahkan isi supplier');
            }

            $totalPrice += $item->total_beli;
            $total += $item->quantity;
            $productNames[] = $item->name . '(' . $item->quantity . ')';
            $supplier = $item->supplier;

            $kelola_barang = Kelola_barang::where('nama_barang', $item->name)->first();

            if ($kelola_barang) {
                $kelola_barang->quantity += $item->quantity;
                $kelola_barang->save();
            } else {
                return back()->with('error', 'Barang tidak ditemukan');
            }
        }

        $productList = implode(', ', $productNames);

        Kelola_pembelian::truncate();

            $notabarang = new Nota_barang();
            $notabarang->tanggal_transaksi = now();
            $notabarang->supplier = $supplier;
            $notabarang->jumlah = $total;
            $notabarang->total = $totalPrice;
            $notabarang->barang = $productList;
            $notabarang->save();

        return back()->with('success', 'Data berhasil diproses');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $qtyy = $request->input('qtyy');

    // Ambil stok dari database berdasarkan ID yang diberikan
    $item = Kelola_barang::findOrFail($id);

    if ($item->quantity >= $qtyy && $qtyy > 0) {
        // Periksa apakah produk sudah ada
        $items = Kelola_pembelian::where('name', $item->nama_barang)->first();

        if (!$items) {
            // Produk belum ada, buat entri produk baru
            $items = new Kelola_pembelian();
            $items->name = $item->nama_barang;
            $items->price = $item->harga_barang;
            $items->total_beli = $qtyy * $item->harga_barang;
            $items->product_img = $item->product_img;
            $items->quantity = $qtyy;
            $items->tanggal = now();
            $items->save();
        } else {
            // Produk sudah ada, tambahkan qty2 ke quantity
            $items->quantity += $qtyy;
            $items->total_beli = $items->quantity * $item->harga_barang;
            $items->save();
        }

        return back()->with('success', ' Barang berhasil ditambahkan');
    } else {
        return back()->with('error', 'Silahkan isi jumlahnya');
    }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $qty = $request->input('quantity');

        $barang = Kelola_pembelian::findOrFail($id);

        if($barang){
            $barang->quantity=$qty;
            $barang->total_beli=$qty*$barang->price;
            $barang->save();
        }
        return back()->with('success', 'Jumlah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelola = Kelola_pembelian::findOrFail($id);

        $kelola->delete();

        return back()->with('success', 'Data dihapus.');
    }

    public function filterByDate(Request $request)
    {
        $minDate = Nota_barang::min('tanggal_transaksi');
        $maxDate = Nota_barang::max('tanggal_transaksi');

        $start_date = $minDate ?? now()->toDateString();
        $end_date = $maxDate ?? now()->toDateString();

        if ($request->has('start_date')) {
            $start_date = $request->input('start_date');
        }

        if ($request->has('end_date')) {
            $end_date = $request->input('end_date');
        }

        $nota = Nota_barang::whereBetween('tanggal_transaksi', [$start_date, $end_date])->get();

        return view('admin.product.laporan', compact('nota', 'start_date', 'end_date'));
    }

    public function filterByDate2(Request $request)
    {
        $minDate = Jual_barang::min('tanggal_transaksi');
        $maxDate = Jual_barang::max('tanggal_transaksi');

        $start_date = $minDate ?? now()->toDateString();
        $end_date = $maxDate ?? now()->toDateString();

        if ($request->has('start_date')) {
            $start_date = $request->input('start_date');
        }

        if ($request->has('end_date')) {
            $end_date = $request->input('end_date');
        }

        $jual = Jual_barang::whereBetween('tanggal_transaksi', [$start_date, $end_date])->get();

        return view('admin.product.laporan2', compact('jual', 'start_date', 'end_date'));
    }

}

