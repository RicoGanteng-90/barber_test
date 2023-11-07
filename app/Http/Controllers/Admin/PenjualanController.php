<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jual_barang;
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

        $totalPrice = 0;
        $total = 0;
        $productNames = [];

        foreach ($kelola_penjualan as $item) {
            $totalPrice += $item->total;
            $total += $item->jumlah;
            $productNames[] = $item->barang . '(' . $item->jumlah . ')';
            $customer = $item->nama_customer;
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

        return back();
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
