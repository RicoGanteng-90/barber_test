<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jual_barang;
use App\Models\Kelola_barang;
use App\Models\Kelola_penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jualBarang()
    {
        $kelola_penjualan = Kelola_penjualan::all();

        if($kelola_penjualan->isEmpty()) {
            return back()->with('error', 'Tidak ada barang untuk diproses');
        }

        $totalPrice = 0;
        $total = 0;
        $productNames = [];

        foreach ($kelola_penjualan as $item) {

            if (empty($item->nama_customer)) {
                return back()->with('error', 'Silahkan isi customer');
            }

            $totalPrice += $item->total;
            $total += $item->jumlah;
            $productNames[] = $item->barang . '(' . $item->jumlah . ')';
            $customer = $item->nama_customer;

            $kelola_barang = Kelola_barang::where('nama_barang', $item->barang)->first();

            if ($kelola_barang) {
                $kelola_barang->quantity -= $item->jumlah;
                $kelola_barang->save();
            } else {
                return back()->with('error', 'Barang tidak ditemukan');
            }
        }

        $productList = implode(', ', $productNames);

        Kelola_penjualan::truncate();

            $notabarang = new Jual_barang();
            $notabarang->tanggal_transaksi = now();
            $notabarang->customer = $customer;
            $notabarang->jumlah = $total;
            $notabarang->total_harga = $totalPrice;
            $notabarang->barang = $productList;
            $notabarang->save();

        return back()->with('success', 'Data berhasil diproses');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
