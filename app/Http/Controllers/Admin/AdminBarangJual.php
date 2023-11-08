<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelola_barang;
use App\Models\Kelola_penjualan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminBarangJual extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Kelola_barang::all();

        $customer = User::all();

        $buku = Kelola_penjualan::all();

        return view('admin.product.produk', compact('barang', 'customer', 'buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $qtyy = $request->input('qtybarang');

    // Ambil stok dari database berdasarkan ID yang diberikan
    $item = Kelola_barang::findOrFail($id);

    if ($item->quantity >= $qtyy && $qtyy > 0) {
        // Periksa apakah produk sudah ada
        $items = Kelola_penjualan::where('barang', $item->nama_barang)->first();

        if (!$items) {
            // Produk belum ada, buat entri produk baru
            $items = new Kelola_penjualan();
            $items->barang = $item->nama_barang;
            $items->harga = $item->harga_barang;
            $items->jumlah = $qtyy;
            $items->total = $qtyy * $item->harga_barang;
            $items->tanggal_transaksi = now();
            $items->save();
        } else {
            // Produk sudah ada, tambahkan qty2 ke quantity
            $items->jumlah += $qtyy;
            $items->total = $items->jumlah * $item->harga_barang;
            $items->save();
        }

        return back()->with('success', 'pembukuan berhasil');
    } else {
        return back()->with('error', 'Stok habis');
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $items3 = Kelola_penjualan::all();

        foreach($items3 as $items3)
        {
            $customer = User::findOrFail($id);
            if($customer)
            {
                $items3->nama_customer = $customer->nama_user;
                $items3->save();
            }
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $qty = $request->input('quantity2');

        $barang = Kelola_penjualan::findOrFail($id);

        if($barang){
            $barang->jumlah=$qty;
            $barang->save();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelola = Kelola_penjualan::findOrFail($id);

        $kelola->delete();

        return back();
    }
}
