<?php

namespace App\Http\Controllers\Admin;

use App\Models\Items;
use Illuminate\Http\Request;
use App\Models\Stok_supplier;
use App\Http\Controllers\Controller;
use App\Models\Jual_barang;
use App\Models\Kelola_barang;
use App\Models\Kelola_layanan;
use App\Models\Kelola_pembelian;
use App\Models\Kelola_supplier;
use App\Models\Nota_barang;
use App\Models\User;
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
    public function tampilNota()
    {
        $nota = Nota_barang::all();

        return view('admin.product.laporan', compact('nota'));
    }


    public function tampilNota2()
    {
        $jual = Jual_barang::all();

        return view('admin.product.laporan2', compact('jual'));
    }
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

}

