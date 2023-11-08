<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Kelola_layanan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layanan = Kelola_layanan::all();

        $layan = Feature::all();

        $user = User::all();

        return view('admin.layanan.service', compact('layanan', 'layan', 'user'));
    }

    public function tambahUser(Request $request, $id)
    {
        $items2 = Feature::all();

        foreach($items2 as $items2)
        {
            $supplier = User::findOrFail($id);
            if($supplier)
            {
                $items2->customer = $supplier->nama_user;
                $items2->save();
            }
        }
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
    $qtyy = $request->input('qtylayanan');
    $item = Kelola_layanan::findOrFail($id);

    if ($item->quantity >= $qtyy && $qtyy > 0) {
        $items = Feature::where('name', $item->nama_layanan)->first();

        if (!$items) {
            // Produk belum ada, buat entri produk baru
            $items = new Feature();
            $items->name = $item->nama_layanan;
            $items->price = $item->harga_layanan;
            $items->tanggal = now();
            $items->subtotal = $qtyy * $item->harga_layanan;
            $items->total = $qtyy;
            $items->save();
        } else {
            // Produk sudah ada, tambahkan qty2 ke quantity
            $items->total += $qtyy;
            $items->subtotal = $items->total * $item->harga_layanan;
            $items->save();
        }

        return back()->with('success', 'Stok berhasil diperbarui');
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
        $qty = $request->input('quantity');

        $barang = Feature::findOrFail($id);

        if($barang){
            $barang->total=$qty;
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
        $kelola = Feature::findOrFail($id);

        $kelola->delete();

        return back();
    }
}
