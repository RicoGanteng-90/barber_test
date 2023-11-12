<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Jual_layanan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layanan = Jual_layanan::all();

        return view('admin.layanan.laporan3', compact('layanan'));
    }

    public function tampilUser()
    {
        $user = User::all();

        return view('admin.layanan.service', compact('user'));
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


    public function jualLayanan(){
        $feature = Feature::all();

        if($feature->isEmpty()) {
            return back()->with('error', 'Tidak ada barang untuk diproses');
        }

        $totalPrice = 0;
        $total = 0;
        $productNames = [];

        foreach ($feature as $item) {

            if (empty($item->customer)) {
                return back()->with('error', 'Silahkan isi customer');
            }

            $totalPrice += $item->subtotal;
            $total += $item->total;
            $productNames[] = $item->name . '(' . $item->total . ')';
            $customer = $item->customer;
        }

        $productList = implode(', ', $productNames);

        Feature::truncate();

            $notabarang = new Jual_layanan();
            $notabarang->tanggal_transaksi = now();
            $notabarang->customer = $customer;
            $notabarang->jumlah = $total;
            $notabarang->total_harga = $totalPrice;
            $notabarang->layanan = $productList;
            $notabarang->save();

        return back()->with('success', 'Data berhasil diproses');
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
